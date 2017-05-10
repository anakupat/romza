<?php
/* * ********************************************************************************************
 *								Open Real Estate
 *								----------------
 * 	version				:	V1.19.3
 * 	copyright			:	(c) 2016 Monoray
 * 							http://monoray.net
 *							http://monoray.ru
 *
 * 	website				:	http://open-real-estate.info/en
 *
 * 	contact us			:	http://open-real-estate.info/en/contact-us
 *
 * 	license:			:	http://open-real-estate.info/en/license
 * 							http://open-real-estate.info/ru/license
 *
 * This file is part of Open Real Estate
 *
 * ********************************************************************************************* */

class MainController extends ModuleAdminController{
	public $modelName = 'InfoPages';
	public $filter = array();
	public $filterEntries = array();
	public $addedFields = null;
	public $addedFieldsEntries = null;

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('infopages_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function init() {
		parent::init();

		$this->filter = array(
			'country_id' => 0,
			'region_id' => 0,
			'city_id' => 0,
			'type' => 0,
			'obj_type_id' => 0,
			'rooms' => 0,
			'ot' => 0,
			'wp' => 0,
			'square_min' => '',
			'square_max' => '',
			'floor_min' => '',
			'floor_max' => '',
			'parent_id' => 0,
		);

		$addedFields = InfoPages::getAddedFields();

		if ($addedFields) {
			$this->addedFields = $addedFields;

			foreach($addedFields as $field) {
				$this->filter[$field['field']] = '';
			}
		}
		
		if (issetModule('metroStations')) {
			$this->filter['metro'] = array();
		}
		
		$this->filterEntries = array('category_id');
	}

	public function getFilterValue($key, $default = 0){
		return isset($this->filter[$key]) ? $this->filter[$key] : $default;
	}
	
	public function getFilterEntriesValue($key){
		return isset($this->filterEntries[$key]) ? $this->filterEntries[$key] : 0;
	}

	public function actionCreate(){
		$model = new $this->modelName;

		$this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];
			if($model->save()){
				Yii::app()->user->setFlash('success', tc('Success'));
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('admin'));
			}
		}

		$this->render('create', array('model'=>$model, 'addedFields' => $this->addedFields));
	}

	public function actionUpdate($id){
		$model = $this->loadModel($id);

		if(($model->widget == 'apartments' || $model->widget == 'seosummaryinfo') && $model->widget_data){
			$arr = CJSON::decode($model->widget_data);
			if(is_array($arr)){
				$this->filter = CMap::mergeArray($this->filter, $arr);
			}
		}
		
		if($model->widget == 'entries' && $model->widget_data){
            $this->filterEntries = CJSON::decode($model->widget_data);
        }

		$this->performAjaxValidation($model);
		
		if (isset($this->filter['parent_id']) && $this->filter['parent_id']) {
			$parentIdInfo = Apartment::model()->findByPk($this->filter['parent_id']);
			$data = array(
				'{id}' => tt('ID', 'apartments').':'.$parentIdInfo->id,
				'{title}' => $parentIdInfo->getStrByLang('title'),
				'{address}' => $parentIdInfo->getStrByLang('address'),
			);
			$model->parent_id_autocomplete = strtr(Apartment::$_parentAutoCompleteTemplate, $data);
		}

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];
			if($model->save()){
				Yii::app()->user->setFlash('success', tc('Success'));
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('admin'));
			}
		}

		$this->render('update', array('model'=>$model, 'addedFields' => $this->addedFields));
	}

	public function actionDelete($id){
		if($id == InfoPages::MAIN_PAGE_ID || $id == InfoPages::LICENCE_PAGE_ID){
			Yii::app()->user->setFlash('error', tt('backend_menumanager_main_admin_noDeleteSystemItem', 'menumanager'));
			$this->redirect('admin');
		}

		if (Yii::app()->cache->get('menu'))
			Yii::app()->cache->delete('menu');

		parent::actionDelete($id);
	}
	
	public function actionGetParentObject() {
		if(Yii::app()->request->isAjaxRequest) {
			if(isset($_GET['q'])) {
				$q = filter_var($_GET['q'], FILTER_SANITIZE_STRING);
				
				if ($q) {
					$user = HUser::getModel();
					$addWhere = '';
					if(!in_array($user->role, array(User::ROLE_ADMIN, User::ROLE_MODERATOR))){
						$addWhere = " AND owner_id = ".Yii::app()->user->id;
					}

					$sql = "
							SELECT id, title_".Yii::app()->language." AS title, address_".Yii::app()->language." AS address FROM {{apartment}} 
							WHERE 
							(id LIKE :keyword OR title_".Yii::app()->language." LIKE :keyword OR address_".Yii::app()->language." LIKE :keyword)
							" . $addWhere . " 
							LIMIT 30";
					$list = Yii::app()->db->createCommand($sql)->queryAll(
							true, 
							array(
								':keyword' => '%'.strtr($q,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
							)
						);
					
					$returnVal = '';
					if (!empty($list)) {
						foreach ($list as $key => $value) {
							$data = array(
								'{id}' => tt('ID', 'apartments').':'.$value['id'],
								'{title}' => $value['title'],
								'{address}' => $value['address'],
							);
							$returnVal .= strtr(Apartment::$_parentAutoCompleteTemplate, $data).'|'.$value['id']."\n";
						}
					}
					
					unset($list);
					echo $returnVal;
				}
			}
		}
	}
}