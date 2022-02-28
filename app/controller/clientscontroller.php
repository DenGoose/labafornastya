<?php

namespace App\Controller;

class ClientsController extends \Lib\Controller\BaseController
{

	public function show()
	{
		\Lib\View\ViewManager::show('index', $this->params);

	}
}