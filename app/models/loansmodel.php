<?php

namespace App\Models;

class LoansModel extends \Lib\Model\BaseModel
{
	public static function create($fields)
	{
		$sql = 'insert into loans (photo, loan_purpose, manager_comment, loan_amount, id_client) values (:photo, :loan_purpose, :manager_comment, :loan_amount, :id_client)';

		self::query($sql, [
			':photo' => $fields['photo'],
			':loan_purpose' => $fields['loan_purpose'],
			':manager_comment' => $fields['manager_comment'],
			':loan_amount' => $fields['loan_amount'],
			':id_client' => $fields['id_client'],
		]);
	}

	public static function read($filter = '', $params = []): array
	{
		$sql = 'select loans.id, loans.photo, loans.loan_purpose, loans.manager_comment, loans.loan_amount, clients.name, loans.id_client from loans 
    		join clients on clients.id = loans.id_client';

		if ($filter)
		{
			$sql .= ' where ' . $filter;
		}

		$ob = self::query($sql, $params);

		$result = [];

		while ($itm = $ob->fetch(\PDO::FETCH_ASSOC))
		{
			$temp = [];

			foreach ($itm as $columnName => $item)
			{
				$temp[$columnName] = [
					'value' => $item,
					'type' => $columnName == 'photo' ? 'photo' : 'text'
				];
			}
			$result[$itm['id']] = $temp;
		}

		return $result;
	}

	public static function update($set, $filter, $fields)
	{
		$sql = 'update loans set ' . $set . ' where ' . $filter;

		self::query($sql, $fields);
	}

	public static function delete($filter, $fields)
	{
		$sql = 'delete from loans where ' . $filter;

		self::query($sql, $fields);
	}
}