<?php

namespace App\Models;

class SalePointModel extends \Lib\Model\BaseModel
{

	public static function create($fields)
	{
		$sql = 'insert into sale_points (name) values (:name)';

		self::query($sql, [':name' => $fields['name']]);
	}

	public static function read($filter = '', $params = []): array
	{
		$sql = 'select id, name from sale_points';

		if ($filter)
		{
			$sql .= ' where ' . $filter;
		}

		$ob = self::query($sql, $params);

		$result = [];

		while ($itm = $ob->fetch(\PDO::FETCH_ASSOC))
		{
			$result[$itm['id']] = $itm;
		}

		return $result;
	}

	public static function update($set, $filter, $fields)
	{
		$sql = 'update sale_points set ' . $set . ' where ' . $filter;

		self::query($sql, $fields);
	}

	public static function delete($filter, $fields)
	{
		$sql = 'delete from sale_points where ' . $filter;

		self::query($sql, $fields);
	}
}