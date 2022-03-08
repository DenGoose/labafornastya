<?php

namespace App\Controller;

use App\Models\SalePointModel;

class SalePointsController extends \Lib\Controller\BaseController
{
	public function show()
	{
		$result = [];

		$result['columns'] = ['ID', 'Имя'];
		$result['items'] = SalePointModel::read();

		if (isset($_SESSION['msg']))
		{
			$result['alert']['text'] = $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		self::includeView('table', $result);
	}

	public function showEditPage()
	{
		if (!intval($this->params['request']['get']['id']))
		{
			header('Location: /sale_points/');
		}
		$result = [];

		$db = SalePointModel::read(
			'id = :id',
			[':id' =>  $this->params['request']['get']['id']]
		);

		$result['items'][] = [
			'name' => 'Имя точки продаж',
			'code' => 'name',
			'type' => 'text',
			'value' => $db[$this->params['request']['get']['id']]['name']
		];

		$result['items'][] = [
			'code' => 'id',
			'value' => $this->params['request']['get']['id']
		];

		$this->params['title'] = str_replace('!NAME!', 'asdasd', $this->params['title']);

		$result['action'] = '/sale_points/edit/';

		self::includeView('record', $result);
	}

	public function edit()
	{
		if (SalePointModel::read('id = :id', [':id' => $this->params['request']['post']['id']]))
		{
			SalePointModel::update('name = :name', 'id = :id', [':id' => $this->params['request']['post']['id'], ':name' => $this->params['request']['post']['name']]);
			$_SESSION['msg'] = 'Точка успешно изменена';
			header('Location: /sale_points/');
			die();
		}
		else
		{
			header('Location: /sale_points/');
			die();
		}
	}

	public function showAddPage($fields = [])
	{
		$result = [];

		if (!$fields)
		{
			$result['items'][] = [
				'name' => 'Имя точки продаж',
				'code' => 'name',
				'type' => 'text'
			];
		}
		else
		{
			$result['items'][] = [
				'name' => 'Имя точки продаж',
				'code' => 'name',
				'type' => 'text',
				'value' => $fields['name'],
				'error' => $fields['error']
			];
		}

		$result['action'] = '/sale_points/add/';

		self::includeView('record', $result);
	}

	public function add()
	{
		if (!SalePointModel::read('name = :name', [':name' => $this->params['request']['post']['name']]))
		{
			SalePointModel::create($this->params['request']['post']);
			$_SESSION['msg'] = 'Точка успешно добавлена';
			header('Location: /sale_points/');
			die();
		}
		else
		{
			self::showAddPage([
				'name' => $this->params['request']['post']['name'],
				'error' => 'Такая точка уже существует'
			]);
		}
	}

	public function delete()
	{
		if (SalePointModel::read('id = :id', [':id' => $this->params['request']['get']['id']]))
		{
			SalePointModel::delete('id = :id', [':id' => $this->params['request']['get']['id']]);
			$_SESSION['msg'] = 'Точка успешно удалена';
			header('Location: /sale_points/');
			die();
		}
		else
		{
			header('Location: /sale_points/');
			die();
		}
	}
}