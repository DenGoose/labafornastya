<?php

namespace App\Controller;

use App\Models\ClientsModel;

class ClientsController extends \Lib\Controller\BaseController
{
	/**
	 * Отображает страницу с Клиентами
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function show()
	{
		$result = [];

		$result['columns'] = ['ID', 'ФИО'];
		$result['items'] = ClientsModel::read();

		if (isset($_SESSION['msg']))
		{
			$result['alert']['text'] = $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		self::includeView('table', $result);
	}

	/**
	 * Отображает страницу изменения Клиента
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function showEditPage()
	{
		if (!intval($this->params['request']['get']['id']))
		{
			header('Location: /clients/');
		}
		$result = [];

		$db = ClientsModel::read(
			'id = :id',
			[':id' =>  $this->params['request']['get']['id']]
		);

		$result['items'][] = [
			'name' => 'ФИО клиента',
			'code' => 'name',
			'type' => 'text',
			'value' => $db[$this->params['request']['get']['id']]['name']['value']
		];

		$result['items'][] = [
			'code' => 'id',
			'value' => $this->params['request']['get']['id']
		];

		$this->params['title'] = str_replace('!NAME!', $db[$this->params['request']['get']['id']]['name']['value'], $this->params['title']);

		$result['action'] = '/clients/edit/';

		self::includeView('record', $result);
	}

	/**
	 * Изменяет запись о Клиенте
	 *
	 * @return void
	 */
	public function edit()
	{
		if (ClientsModel::read('id = :id', [':id' => $this->params['request']['post']['id']]))
		{
			ClientsModel::update('name = :name', 'id = :id', [':id' => $this->params['request']['post']['id'], ':name' => $this->params['request']['post']['name']]);
			$_SESSION['msg'] = 'Точка успешно изменена';
			header('Location: /clients/');
			die();
		}
		else
		{
			header('Location: /clients/');
			die();
		}
	}

	/**
	 * Отображает страницу добавления Клиента
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function showAddPage($fields = [])
	{
		$result = [];

		if (!$fields)
		{
			$result['items'][] = [
				'name' => 'ФИО клиента',
				'code' => 'name',
				'type' => 'text'
			];
		}
		else
		{
			$result['items'][] = [
				'name' => 'ФИО клиента',
				'code' => 'name',
				'type' => 'text',
				'value' => $fields['name'],
				'error' => $fields['error']
			];
		}

		$result['action'] = '/clients/add/';

		self::includeView('record', $result);
	}

	/**
	 * Добавляет Клиента
	 *
	 * @return void
	 */
	public function add()
	{
		if (!ClientsModel::read('name = :name', [':name' => $this->params['request']['post']['name']]))
		{
			ClientsModel::create($this->params['request']['post']);
			$_SESSION['msg'] = 'Клиент успешно добавлен';
			header('Location: /clients/');
			die();
		}
		else
		{
			self::showAddPage([
				'name' => $this->params['request']['post']['name'],
				'error' => 'Такой клиент уже существует'
			]);
		}
	}

	/**
	 * Удаляет клиента
	 *
	 * @return void
	 */
	public function delete()
	{
		if (ClientsModel::read('id = :id', [':id' => $this->params['request']['get']['id']]))
		{
			ClientsModel::delete('id = :id', [':id' => $this->params['request']['get']['id']]);
			$_SESSION['msg'] = 'Клиент успешно удалён';
			header('Location: /clients/');
			die();
		}
		else
		{
			header('Location: /clients/');
			die();
		}
	}
}