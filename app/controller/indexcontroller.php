<?php

namespace App\Controller;

use Lib\DataBase\DB;

class IndexController extends \Lib\Controller\BaseController
{
	/**
	 * Отображает страницу с сущностями
	 *
	 * @throws \Exception
	 */
	public function exec()
	{
		$pages = [
			[
				'url' => '/clients/',
				'name' => 'Клиенты'
			],
			[
				'url' => '/loans/',
				'name' => 'Займы'
			]
		];

		self::includeView('index', $pages);
	}
}