<?php
	$this->Form->templates([
		"inputContainer" => "{{content}}"
	]);
?>

<section id="main" >
	<div class="inner">
		<header class="major special">
			<h1><?= __("Monsters - XML") ?></h1>
		</header>

		<?=
			$this
				->Form
				->input(
					"include_all",
					[
						"label" => false,
						"type" => "checkbox"
					]
				)
		?>
		<label for="include-all"><?= __("Include All") ?></label>

		<br>

		<?=
			$this
				->Form
				->create(
					null,
					[
						"data-no_monsters" => __("You have to select at least one monster.")
					]
				)
		?>

			<?=
				$this
					->Form
					->input(
						"loot",
						[
							"label" => false,
							"type" => "checkbox",
							"checked" => true
						]
					)
			?>
			<label for="loot"><?= __("Show Loot") ?></label>

			<?=
				$this
					->Form
					->submit(
						__("Submit")
					)
			?>
		<br>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-wrapper">
						<table>
							<thead>
								<tr>
									<th width="100"><?= __("Include") ?></th>
									<th><?= __("Name") ?></th>
									<th><?= __("File") ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($monsters as $index => $monster): ?>
									<tr>
										<td>
											<?=
												$this
													->Form
													->input(
														"monsters.$index",
														[
															"label" => false,
															"type" => "checkbox",
															"value" => $monster["@file"]
														]
													)
											?>
											<label for="monsters-<?= $index ?>"></label>
										</td>
										<td>
											<?= h($monster["@name"]) ?>
										</td>
										<td>
											<?= h($monster["@file"]) ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3">
										<?=
											$this
												->Form
												->submit(
													__("Submit")
												)
										?>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		<?=
			$this
				->Form
				->end()
		?>
	</div>
</section>
