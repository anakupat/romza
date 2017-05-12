<?php
$this->breadcrumbs=array(tc('Overview'));
$this->menu = array();

$this->adminTitle = tc('Overview');
?>

<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><?php echo tc('Listings awaiting confirmation');?></span>
				<span class="info-box-number"><?php echo ($adminStatsBage && isset($adminStatsBage['countApartmentModeration'])) ? $adminStatsBage['countApartmentModeration'] : 0;?></span>
			</div><!-- /.info-box-content -->
		</div><!-- /.info-box -->
	</div><!-- /.col -->
	
	<?php if (issetModule('messages')):?>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-envelope-o"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo tc('New private messages');?></span>
					<span class="info-box-number"><?php echo ($adminStatsBage && isset($adminStatsBage['countMessagesUnread'])) ? $adminStatsBage['countMessagesUnread'] : 0;?></span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div><!-- /.col -->
	<?php endif;?>
		
	<?php if (issetModule('comments')):?>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-comment-o"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo tc('Comments awaiting confirmation');?></span>
					<span class="info-box-number"><?php echo ($adminStatsBage && isset($adminStatsBage['countCommentPending'])) ? $adminStatsBage['countCommentPending'] : 0;?></span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div><!-- /.col -->
	<?php endif;?>
</div>

<div class="row">
	<?php if (issetModule('bookingtable')):?>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-olive"><i class="fa fa-book"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo tc('New bookings');?></span>
					<span class="info-box-number"><?php echo ($adminStatsBage && isset($adminStatsBage['countNewPending'])) ? $adminStatsBage['countNewPending'] : 0;?></span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div><!-- /.col -->
	<?php endif;?>
	
	<?php if (param('allowCustomCities', 0)):?>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-purple"><i class="fa fa-globe"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo tc('Cities awaiting moderation');?></span>
					<span class="info-box-number"><?php echo ($adminStatsBage && isset($adminStatsBage['countCitiesModeration'])) ? $adminStatsBage['countCitiesModeration'] : 0;?></span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div><!-- /.col -->
	<?php endif;?>
	
	<?php if (issetModule('payment')):?>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-teal"><i class="fa fa-money"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo tc('New payments');?></span>
					<span class="info-box-number"><?php echo ($adminStatsBage && isset($adminStatsBage['countPaymentWait'])) ? $adminStatsBage['countPaymentWait'] : 0;?></span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div><!-- /.col -->
	<?php endif;?>
</div>

