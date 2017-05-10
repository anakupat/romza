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

	class CustomHttpRequest extends CHttpRequest
    {

        private $_csrfToken;

		public function validateCsrfToken($event){
			if($this->getIsPostRequest()){
				$cookies=$this->getCookies();
				if($cookies->contains($this->csrfTokenName) && isset($_POST[$this->csrfTokenName]) || isset($_GET[$this->csrfTokenName] )){
					$tokenFromCookie=$cookies->itemAt($this->csrfTokenName)->value;
					$tokenFrom=!empty($_POST[$this->csrfTokenName]) ? $_POST[$this->csrfTokenName] : $_GET[$this->csrfTokenName];
					$valid=$tokenFromCookie===$tokenFrom;
				}
				else
					$valid=false;
				if(!$valid)
					throw new CHttpException(400,Yii::t('yii','Lite: The CSRF token could not be verified.'));
			}
		}

        public $noCsrfValidationRoutes = array();

        protected function normalizeRequest(){
            parent::normalizeRequest();

            if($_SERVER['REQUEST_METHOD'] != 'POST') return;

            $route = Yii::app()->getUrlManager()->parseUrl($this);
            if($this->enableCsrfValidation){
                foreach($this->noCsrfValidationRoutes as $cr){
                    if(preg_match('#'.$cr.'#', $route)){
                        Yii::app()->detachEventHandler('onBeginRequest',
                            array($this,'validateCsrfToken'));
                        Yii::trace('Route "'.$route.' passed without CSRF validation');
                        break; // found first route and break
                    }
                }
            }
        }

        public function getCsrfToken()
        {
            if($this->_csrfToken===null)
            {
                $cookie=$this->getCookies()->itemAt($this->csrfTokenName);

                if($cookie){
                    $this->_csrfToken = preg_replace('/[^a-z0-9]/', '', $cookie->value);
                }

                if(!$cookie || !$this->_csrfToken)
                {
                    $cookie=$this->createCsrfCookie();
                    $this->_csrfToken = $cookie->value;
                    $this->getCookies()->add($cookie->name,$cookie);
                }
            }

            return $this->_csrfToken;
        }
	}