<?php

// Индексовая страница

\Lib\Http\Router::getInstance()->run(
	'/',
	'IndexController',
	'exec',
	'get',
	[
		'title' => 'Главная страница'
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

\Lib\Http\Router::getInstance()->run(
	'/clients/edit/',
	'ClientsController',
	'showEditPage',
	'get',
	[
		'title' => 'Изменение клиента !NAME!'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/edit/',
	'ClientsController',
	'edit',
	'post',
	[
		'title' => 'Изменение клиента'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/add/',
	'ClientsController',
	'showAddPage',
	'get',
	[
		'title' => 'Добавить клиента'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/add/',
	'ClientsController',
	'add',
	'post',
	[
		'title' => 'Добавить клиента'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/delete/',
	'ClientsController',
	'delete',
	'get',
	[
		'title' => 'Добавить клиента'
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

\Lib\Http\Router::getInstance()->run(
	'/loans/edit/',
	'LoansController',
	'showEditPage',
	'get',
	[
		'title' => 'Изменение займа №!ID!'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/edit/',
	'LoansController',
	'edit',
	'post',
	[
		'title' => 'Изменение займа'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/add/',
	'LoansController',
	'showAddPage',
	'get',
	[
		'title' => 'Добавить займ'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/add/',
	'LoansController',
	'add',
	'post',
	[
		'title' => 'Добавить займ'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/delete/',
	'LoansController',
	'delete',
	'get',
	[
		'title' => 'Добавить займ'
	]
);