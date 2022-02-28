<?php

namespace App\Controller;

class LoansController extends \Lib\Controller\BaseController
{

	public function show()
	{
		\Lib\View\ViewManager::show('index', $this->params);

	}
}