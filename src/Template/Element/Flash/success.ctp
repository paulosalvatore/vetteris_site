<?php
	if (!isset($params["escape"]) || $params["escape"] !== false)
		$message = h($message);
?>

<div class="alert alert-success alert-icon-block alert-dismissible" role="alert" data-dismiss="alert">
	<div class="alert-icon">
		<span class="icon-menu-circle fa fa-smile-o"></span>
	</div>
	<strong><?= __("Yeah!") ?></strong> <?= $message ?>
	<div class="close" aria-label="Close">
		<span class="fa fa-times"></span>
	</div>
</div>
