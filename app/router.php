<?php

// Индексовая страница

\Lib\Http\Router::getInstance()->run(
	'/',
	'IndexController',
	'exec',
	'get',
	[
		'title' => 'Мэин пейдж'
	]
);

// Точки продаж

\Lib\Http\Router::getInstance()->run(
	'/sale_points/',
	'SalePointsController',
	'show',
	'get',
	[
		'title' => 'Точки продаж'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/sale_points/edit/',
	'SalePointsController',
	'showEditPage',
	'get',
	[
		'title' => 'Изменение точки !NAME!'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/sale_points/edit/',
	'SalePointsController',
	'edit',
	'post',
	[
		'title' => 'Изменение точки'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/sale_points/add/',
	'SalePointsController',
	'showAddPage',
	'get',
	[
		'title' => 'Добавить точку'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/sale_points/add/',
	'SalePointsController',
	'add',
	'post',
	[
		'title' => 'Добавить точку'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/sale_points/delete/',
	'SalePointsController',
	'delete',
	'get',
	[
		'title' => 'Добавить точку'
	]
);

// Менеджеры

\Lib\Http\Router::getInstance()->run(
	'/managers/',
	'ManagersController',
	'show',
	'get',
	[
		'title' => 'Менеджеры'
	]
);

// Клиенты

\Lib\Http\Router::getInstance()->run(
	'/clients/',
	'ClientsController',
	'show',
	'get',
	[
		'title' => 'Клиенты'
	]
);

// Займы

\Lib\Http\Router::getInstance()->run(
	'/loans/',
	'LoansController',
	'show',
	'get',
	[
		'title' => 'Займы'
	]
);

// Платежи

\Lib\Http\Router::getInstance()->run(
	'/payments/',
	'PaymentsController',
	'show',
	'get',
	[
		'title' => 'Платежи'
	]
);