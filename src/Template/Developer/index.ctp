<section id="main" >
	<div class="inner">
		<header class="major special">
			<h1>Developer Room</h1>
		</header>

		<header class="major special">
			<h3>Work with XML</h3>
		</header>
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<?=
					$this
						->Html
						->link(
							"Monsters",
							[
								"controller" => "Developer",
								"action" => "monsters_xml"
							],
							[
								"class" => "button fit"
							]
						)
				?>
			</div>
		</div>
	</div>
</section>
