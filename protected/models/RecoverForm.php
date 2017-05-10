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

class RecoverForm extends CFormModel {
	public $email;
	public $verifyCode;

	public function rules() {
		return array(
			array('email', 'filter', 'filter'=>'trim'),
			array('email, verifyCode', 'required'),
			array('email', 'email'),
			array('verifyCode', 'captcha'),
		);
	}

	public function attributeLabels() {
		return array(
			'recoverPass'=>tc('Forgot password?'),
			'email'=> tc('Email'),
			'verifyCode' => tc('Verify Code'),
		);
	}
}
