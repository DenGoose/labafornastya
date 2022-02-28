<?php

namespace App\Controller;

use Lib\DataBase\DB;

class IndexController extends \Lib\Controller\BaseController
{
	/**
	 * @throws \Exception
	 */
	public function exec()
	{
		$this->params['db'] = DB::getInstance()->getConnection()->query('show tables')->fetchAll(\PDO::FETCH_ASSOC);

		\Lib\View\ViewManager::show('index', $this->params);
	}
}