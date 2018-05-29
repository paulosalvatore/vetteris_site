<?php
	if (!isset($params["escape"]) || $params["escape"] !== false)
		$message = h($message);
?>

<div class="alert alert-danger alert-icon-block alert-dismissible" role="alert" data-dismiss="alert">
	<div class="alert-icon">
		<span class="icon-menu-circle fa fa-warning"></span>
	</div>
	<strong><?= __("Ooops...") ?></strong> <?= $message ?>
	<div class="close" aria-label="Close">
		<span class="fa fa-times"></span>
	</div>
</div>
