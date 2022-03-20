<?php
session_start();

// Создаёт папку с файлами для сохранения
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/files'))
{
	mkdir($_SERVER['DOCUMENT_ROOT'] . '/files');
}

// Подключаем автоподгрузку классов
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

// Ищем нужную нам страницу
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/router.php';

// Если не нашёл нужную страницу, то показываем 404
\Lib\View\ViewManager::show('404');