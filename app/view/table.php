<?php /* @var array $params */ ?>
<?php \Lib\View\ViewManager::show('header', ['title' => $params['title']]); ?>

<?php if ($params['result']):?>
<?php if (isset($params['result']['alert'])):?>
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <?=$params['result']['alert']['text']?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif;?>
<table class="table table-striped mt-3">
	<thead>
	<tr>
		<?php foreach ($params['result']['columns'] as $column): ?>
			<th scope="col"><?=$column?></th>
		<?php endforeach; ?>
		<th scope="col">Действия</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($params['result']['items'] as $item): ?>
	<tr>
		<?php foreach ($item as $el): ?>
			<td><?=$el?></td>
		<?php endforeach;?>
		<td>
			<a href="<?=$params['currentUrl']?>edit/?id=<?=$item['id']?>&name=<?=$item['name']?>" class="btn btn-warning">Изменить</a>
			<a href="<?=$params['currentUrl']?>delete/?id=<?=$item['id']?>&name=<?=$item['name']?>" class="btn btn-danger">Удалить</a>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>
<?php else:?>
    <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
        Элементов не найдено
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif;?>
<div class="pt-5">
    <a href="<?=$params['currentUrl']?>add/" class="btn btn-success">Добавить запись</a>
</div>

<?php \Lib\View\ViewManager::show('footer'); ?>
