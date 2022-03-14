<?php

namespace App\Models;

class ClientsModel extends \Lib\Model\BaseModel
{
	public static function create($fields)
	{
		$sql = 'insert into clients (name) values (:name)';

		self::query($sql, [':name' => $fields['name']]);
	}

	public static function read($filter = '', $params = []): array
	{
		$sql = 'select id, name from clients';

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
					'type' => 	'text'
				];
			}
			$result[$itm['id']] = $temp;
		}

		return $result;
	}

	public static function update($set, $filter, $fields)
	{
		$sql = 'update clients set ' . $set . ' where ' . $filter;

		self::query($sql, $fields);
	}

	public static function delete($filter, $fields)
	{
		$sql = 'delete from clients where ' . $filter;

		self::query($sql, $fields);
	}
}