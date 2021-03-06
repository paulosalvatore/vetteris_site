<?php
	$this->Form->templates([
		"inputContainer" => "{{content}}"
	]);
?>

<section id="main" >
	<div class="inner">
		<?=
			$this
				->Html
				->link(
					__("Back to Monsters"),
					[
						"action" => "monsters_xml"
					],
					[
						"class" => "button"
					]
				)
		?>

		<header class="major special">
			<h1><?= __("Items - XML") ?></h1>
		</header>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="table-wrapper">
					<table>
						<thead>
							<tr>
								<th width="50"><?= __("Image") ?></th>
								<th>ID</th>
								<th><?= __("Name") ?></th>
								<th><?= __("Monsters") ?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($items as $index => $item): ?>
								<tr>
									<td>
										<?=
											$this
												->Html
												->image(
													$item->image
												)
										?>
									</td>
									<td>
										<?= h($item->id) ?>
									</td>
									<td>
										<?= h($item->name) ?>
									</td>
									<td>
										<?= $item->showMonsters() ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
