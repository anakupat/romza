<?php
$this->breadcrumbs=array(
	tt('Manage clients', 'clients') => array('admin'),
	tt('Add client', 'clients'),
);
$this->menu = array(
	AdminLteHelper::getBackMenuLink(tt('Manage clients', 'clients'), array('admin')),
);
$this->adminTitle = tt('Add client', 'clients');
?>

<?php
	$this->renderPartial('_form',array(
		'model'=>$model,
	));
?>