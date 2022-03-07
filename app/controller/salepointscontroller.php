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

	public function showEditPage()
	{
		if (!intval($this->params['request']['get']['id']))
		{
			header('Location: /'); // todo доделать
		}
		$result = [];

		$db = SalePointModel::read(
			'id=' . $this->params['request']['get']['id'],
			'name'
		);

		$result[] = [
			'name' => 'Имя точки продаж',
			'code' => 'name',
			'type' => 'text',
			//			'error' => 'asdasd'
		];

		self::includeView('record', $result);
	}

	public function showAddPage()
	{
		$result = [];

		$result[] = [
			'name' => 'Имя точки продаж',
			'code' => 'name',
			'type' => 'text'
		];

		self::includeView('record', $result);
	}

	public function delete()
	{

	}
}