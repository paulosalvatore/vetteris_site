<!-- Header -->
<header id="header">
	<div class="inner">
		<?=
			$this
				->Html
				->link(
					"Eldor Realms",
					"/",
					[
						"class" => "logo"
					]
				)
		?>

		<nav id="nav">
			<?=
				$this
					->Html
					->link(
						__("Home"),
						"/"
					)
			?>

			<?=
				$this
					->Html
					->link(
						__("Server Info"),
						"/"
					)
			?>

			<?=
				$this
					->Html
					->link(
						__("Membership"),
						"/"
					)
			?>

			<?=
				$this
					->Html
					->link(
						__("Forum"),
						"/"
					)
			?>

			<?=
				$this
					->Html
					->link(
						__("Sign In"),
						"/"
					)
			?>

			<?=
				$this
					->Html
					->link(
						__("Sign Up"),
						"/"
					)
			?>
		</nav>
	</div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
