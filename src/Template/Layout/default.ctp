<!DOCTYPE HTML>
<!--
	Introspect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
	Adapted by PauloSalvatore
-->

<html>
	<head>
		<?php include_once("includes/css.php"); ?>
		<?php include_once("includes/js.php"); ?>

		<?php
			$arquivoController = "paginas/" . $this->request->controller;
			$caminhoArquivoController = "js/" . $arquivoController . ".js";

			$arquivoAction = $arquivoController . "/" . $this->request->action;
			$caminhoArquivoAction = "js/" . $arquivoAction . ".js";

			if (file_exists(($caminhoArquivoController)))
				echo $this->Html->script($arquivoController);

			if (file_exists(($caminhoArquivoAction)))
				echo $this->Html->script($arquivoAction);
		?>

		<?= $this->Html->charset() ?>
		<title>
			<?= $this->fetch("title") ?>
			- Vetteris
		</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<?= $this->Html->meta("icon") ?>

		<?= $this->fetch("meta") ?>
		<?= $this->fetch("css") ?>
		<?= $this->fetch("script") ?>
	</head>
	<body>
		<div class="alerts">
			<?= $this->Flash->render() ?>
		</div>

		<?= $this->element("header") ?>

		<?= $this->fetch("content") ?>

		<?= $this->element("footer") ?>
	</body>
</html>
