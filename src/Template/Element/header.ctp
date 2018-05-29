<!-- Header -->
<header id="header">
	<div class="inner">
		<?=
			$this
				->Html
				->link(
					"Vetteris",
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

			<?php if ($account["admin_website"]): ?>
				<?=
					$this
						->Html
						->link(
							__("Developer"),
							[
								"controller" => "Developer",
								"action" => "index"
							]
						)
				?>
			<?php endif; ?>

			<?php if (!$account["connected"]): ?>
				<?=
					$this
						->Html
						->link(
							__("Sign In"),
							[
								"controller" => "Accounts",
								"action" => "signin"
							]
						)
				?>

				<?=
					$this
						->Html
						->link(
							__("Sign Up"),
							[
								"controller" => "Accounts",
								"action" => "signup"
							]
						)
				?>
			<?php else: ?>
				<?=
					$this
						->Html
						->link(
							__("Sign Out"),
							[
								"controller" => "Accounts",
								"action" => "signout"
							]
						)
				?>
			<?php endif; ?>
		</nav>
	</div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
