<?php /* @var array $params */ ?>
<?php \Lib\View\ViewManager::show('header', ['title' => 'тайтл']); ?>

<div>
	<h1>
		Какой то див
	</h1>
    <div>
		<?php echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($params, true) . '</pre>'; ?>
    </div>
</div>

<?php \Lib\View\ViewManager::show('footer'); ?>