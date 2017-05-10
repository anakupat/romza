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
	public $modelName = 'NotifierModel';

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('all_modules_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

    public function actionView($id){
        $this->redirect(array('admin'));
    }

}
