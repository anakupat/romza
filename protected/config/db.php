<?php
 return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'CDbConnection',
      'connectionString' => 'mysql:host=localhost;dbname=romza;port=3306',
      'username' => 'root',
      'password' => '',
      'emulatePrepare' => true,
      'charset' => 'utf8',
      'enableParamLogging' => false,
      'enableProfiling' => false,
      'schemaCachingDuration' => 7200,
      'tablePrefix' => 'ore_xy_',
    ),
  ),
  'language' => 'en',
) ;
?>