<?php

// Индексовая страница

\Lib\Http\Router::getInstance()->run(
	'/',
	\App\Controller\IndexController::class,
	'exec',
	'get',
	[
		'title' => 'Главная страница'
	]
);

// Клиенты

\Lib\Http\Router::getInstance()->run(
	'/clients/',
	\App\Controller\ClientsController::class,
	'show',
	'get',
	[
		'title' => 'Клиенты'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/edit/',
	\App\Controller\ClientsController::class,
	'showEditPage',
	'get',
	[
		'title' => 'Изменение клиента !NAME!'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/edit/',
	\App\Controller\ClientsController::class,
	'edit',
	'post',
	[
		'title' => 'Изменение клиента'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/add/',
	\App\Controller\ClientsController::class,
	'showAddPage',
	'get',
	[
		'title' => 'Добавить клиента'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/add/',
	\App\Controller\ClientsController::class,
	'add',
	'post',
	[
		'title' => 'Добавить клиента'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/clients/delete/',
	\App\Controller\ClientsController::class,
	'delete',
	'get',
	[
		'title' => 'Добавить клиента'
	]
);

// Займы

\Lib\Http\Router::getInstance()->run(
	'/loans/',
	\App\Controller\LoansController::class,
	'show',
	'get',
	[
		'title' => 'Займы'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/edit/',
	\App\Controller\LoansController::class,
	'showEditPage',
	'get',
	[
		'title' => 'Изменение займа №!ID!'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/edit/',
	\App\Controller\LoansController::class,
	'edit',
	'post',
	[
		'title' => 'Изменение займа'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/add/',
	\App\Controller\LoansController::class,
	'showAddPage',
	'get',
	[
		'title' => 'Добавить займ'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/add/',
	\App\Controller\LoansController::class,
	'add',
	'post',
	[
		'title' => 'Добавить займ'
	]
);

\Lib\Http\Router::getInstance()->run(
	'/loans/delete/',
	\App\Controller\LoansController::class,
	'delete',
	'get',
	[
		'title' => 'Добавить займ'
	]
);