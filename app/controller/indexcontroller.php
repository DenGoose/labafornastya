<?php

namespace App\Controller;

class IndexController extends \Lib\Controller\BaseController
{
	/**
	 * @throws \Exception
	 */
	public function exec()
	{
		\Lib\View\ViewManager::show('index', $this->params);
	}
}