<?php

namespace App\Controller;

use App\Models\SalePointModel;

class SalePointsController extends \Lib\Controller\BaseController
{
	public function show()
	{
		$result = [];

		$result['columns'] = ['id', 'Имя'];
		$result['items'] = SalePointModel::read();

		self::includeView('table', $result);
	}
}