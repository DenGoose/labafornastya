<?php

namespace App\Controller;

use App\Models\ClientsModel;
use App\Models\LoansModel;

class LoansController extends \Lib\Controller\BaseController
{
	/**
	 * Отображает список Займов
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function show()
	{
		$result = [];

		$result['columns'] = ['ID', 'Фото клиента', 'Цель займа', 'Комментарий менеджера', 'Сумма займа', 'Имя клиента'];

		if (isset($this->params['request']['get']['client_id']) && intval($this->params['request']['get']['client_id']))
		{
			$result['items'] = LoansModel::read('loans.id_client = :id_client', [':id_client' => intval($this->params['request']['get']['client_id'])]);
		}
		else
		{
			$result['items'] = LoansModel::read();
		}

		foreach ($result['items'] as &$item)
		{
			$item['name']['type'] = 'link';
			$item['name']['link'] = '/clients/edit/?id=' . $item['id_client']['value'];
		}

		foreach ($result['items'] as &$itm)
		{
			unset($itm['id_client']);
		}

		if (isset($_SESSION['msg']))
		{
			$result['alert']['text'] = $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		self::includeView('table', $result);
	}

	/**
	 * Отображает страницу с изменением займа
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function showEditPage()
	{
		$clients = [];

		foreach (ClientsModel::read() as $client)
		{
			$temp = [];

			foreach ($client as $fieldName => $field)
			{
				$temp[$fieldName] = $field['value'];
			}

			$clients[] = $temp;
		}

		if (!intval($this->params['request']['get']['id']))
		{
			header('Location: /loans/');
		}
		$result = [];

		$db = LoansModel::read(
			'loans.id = :id',
			[':id' =>  $this->params['request']['get']['id']]
		);

		$result['items'] = [
			[
				'name' => 'Фото клиента',
				'code' => 'photo',
				'type' => 'file'
			],
			[
				'name' => 'Цель займа',
				'code' => 'loan_purpose',
				'type' => 'text',
				'value' => $db[$this->params['request']['get']['id']]['loan_purpose']['value']
			],
			[
				'name' => 'Комментарий менеджера',
				'code' => 'manager_comment',
				'type' => 'text',
				'value' => $db[$this->params['request']['get']['id']]['manager_comment']['value']
			],
			[
				'name' => 'Сумма займа',
				'code' => 'loan_amount',
				'type' => 'text',
				'value' => $_SESSION['fields_msg']['loan_amount']['value'] ?? $db[$this->params['request']['get']['id']]['loan_amount']['value'],
				'error' => $_SESSION['fields_msg']['loan_amount']['msg'] ?? ''
			],
			[
				'name' => 'Клиент',
				'code' => 'id_client',
				'type' => 'list',
				'list_values' => $clients,
				'value' => $db[$this->params['request']['get']['id']]['id_client']['value']
			],
			[
				'code' => 'id',
				'value' => $this->params['request']['get']['id']
			]
		];

		unset($_SESSION['fields_msg']);

		$this->params['title'] = str_replace('!ID!', $this->params['request']['get']['id'], $this->params['title']);

		$result['action'] = '/loans/edit/';

		self::includeView('record', $result);
	}

	/**
	 * Изменяет информацию о займе
	 *
	 * @return void
	 */
	public function edit()
	{
		if (
			intval($this->params['request']['post']['id']) != $this->params['request']['post']['id'] ||
			intval($this->params['request']['post']['loan_amount']) != $this->params['request']['post']['loan_amount'] ||
			intval($this->params['request']['post']['id_client']) != $this->params['request']['post']['id_client']
		)
		{
			$_SESSION['fields_msg']['loan_amount'] = [
				'msg' => intval($this->params['request']['post']['loan_amount']) != $this->params['request']['post']['loan_amount'] ? 'Сумма не должна содержать не цифры' : '',
				'value' => $this->params['request']['post']['loan_amount']
			];

			header('Location: /loans/edit/?id=' . intval($this->params['request']['post']['id']));
			die();
		}

		if (LoansModel::read('loans.id = :id', [':id' => $this->params['request']['post']['id']]))
		{
			$sql = 'loan_purpose = :loan_purpose, manager_comment = :manager_comment, loan_amount = :loan_amount, id_client = :id_client';
			$sqlParams = [
				':id' => $this->params['request']['post']['id'],
				':loan_purpose' => $this->params['request']['post']['loan_purpose'],
				':manager_comment' => $this->params['request']['post']['manager_comment'],
				':loan_amount' => $this->params['request']['post']['loan_amount'],
				':id_client' => $this->params['request']['post']['id_client'],
			];

			if ($this->params['request']['files']['photo']['name'])
			{
				$filePath = '/files/' . $this->params['request']['files']['photo']['name'];

				move_uploaded_file($this->params['request']['files']['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $filePath);

				$sql .= ', photo = :photo';
				$sqlParams[':photo'] = $filePath;
			}


			LoansModel::update(
				$sql,
				'id = :id',
				$sqlParams
			);
			$_SESSION['msg'] = 'Точка успешно изменена';
			header('Location: /loans/');
			die();
		}
		else
		{
			header('Location: /loans/');
			die();
		}
	}

	/**
	 * Отображает страницу с добавлением Займа
	 *
	 * @param $fields
	 * @return void
	 * @throws \Exception
	 */
	public function showAddPage($fields = [])
	{
		$clients = [];

		foreach (ClientsModel::read() as $client)
		{
			$temp = [];

			foreach ($client as $fieldName => $field)
			{
				$temp[$fieldName] = $field['value'];
			}

			$clients[] = $temp;
		}

		$result = [];

		if (!$fields)
		{
			$result['items'] = [
				[
					'name' => 'Фото клиента',
					'code' => 'photo',
					'type' => 'file'
				],
				[
					'name' => 'Цель займа',
					'code' => 'loan_purpose',
					'type' => 'text'
				],
				[
					'name' => 'Комментарий менеджера',
					'code' => 'manager_comment',
					'type' => 'text'
				],
				[
					'name' => 'Сумма займа',
					'code' => 'loan_amount',
					'type' => 'text'
				],
				[
					'name' => 'Клиент',
					'code' => 'id_client',
					'type' => 'list',
					'list_values' => $clients
				]
			];
		}
		else
		{
			$result['items'] = [
				[
					'name' => 'Фото клиента',
					'code' => 'photo',
					'type' => 'file',
					'value' => $fields['photo']['name'] ?? '',
					'error' => $fields['photo']['error'] ?? ''
				],
				[
					'name' => 'Цель займа',
					'code' => 'loan_purpose',
					'type' => 'text',
					'value' => $fields['loan_purpose']['name'] ?? '',
					'error' => $fields['loan_purpose']['error'] ?? ''
				],
				[
					'name' => 'Комментарий менеджера',
					'code' => 'manager_comment',
					'type' => 'text',
					'value' => $fields['manager_comment']['name'] ?? '',
					'error' => $fields['manager_comment']['error'] ?? ''
				],
				[
					'name' => 'Сумма займа',
					'code' => 'loan_amount',
					'type' => 'text',
					'value' => $fields['loan_amount']['name'] ?? '',
					'error' => $fields['loan_amount']['error'] ?? ''
				],
				[
					'name' => 'Клиент',
					'code' => 'id_client',
					'type' => 'list',
					'list_values' => $clients,
					'value' => $fields['id_client']['name'] ?? '',
					'error' => $fields['id_client']['error'] ?? ''
				]
			];
		}

		$result['action'] = '/loans/add/';

		self::includeView('record', $result);
	}

	/**
	 * Добавляет запись о Займе
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function add()
	{
		if (
			intval($this->params['request']['post']['loan_amount']) != $this->params['request']['post']['loan_amount'] ||
			intval($this->params['request']['post']['id_client']) != $this->params['request']['post']['id_client']
		)
		{
			self::showAddPage([
				'loan_amount' => [
					'name' => $this->params['request']['post']['loan_amount'],
					'error' => 'Сумма не должна содержать не цифры'
				]
			]);
			die();
		}

		$filePath = '/files/' . $this->params['request']['files']['photo']['name'];

		if ($this->params['request']['files']['photo']['name'] && move_uploaded_file($this->params['request']['files']['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $filePath))
		{
			$this->params['request']['post']['photo'] = $filePath;
			LoansModel::create($this->params['request']['post']);
			$_SESSION['msg'] = 'Клиент успешно добавлен';
			header('Location: /loans/');
			die();
		}
		else
		{
			self::showAddPage([
				'photo' => [
					'error' => 'Не удалось загрузить файл'
				]
			]);
		}


	}

	/**
	 * Удаляет займ
	 *
	 * @return void
	 */
	public function delete()
	{
		if (LoansModel::read('loans.id = :id', [':id' => $this->params['request']['get']['id']]))
		{
			LoansModel::delete('id = :id', [':id' => $this->params['request']['get']['id']]);
			$_SESSION['msg'] = 'Клиент успешно удалён';
			header('Location: /loans/');
			die();
		}
		else
		{
			header('Location: /loans/');
			die();
		}
	}
}