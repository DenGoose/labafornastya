<?php /* @var array $params */ ?>
<?php \Lib\View\ViewManager::show(
	'header',
	[
		'title' => $params['title'] ?? ''
    ]
); ?>

<div>
	<h5>
		Какой то див
	</h5>
    <div>
		<?php echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($params, true) . '</pre>'; ?>
    </div>
</div>

<?php \Lib\View\ViewManager::show('footer'); ?>