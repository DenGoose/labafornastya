<?php

namespace App\Models;

class SalePointModel extends \Lib\Model\BaseModel
{

	public static function create()
	{
		// TODO: Implement create() method.
	}

	public static function read($filter = ''): array
	{
		$sql = 'select id, name from sale_points';

		if ($filter)
		{
			$sql .= ' where ' . $filter;
		}

		$ob = self::query($sql);

		$result = [];

		while ($itm = $ob->fetch(\PDO::FETCH_ASSOC))
		{
			$result[$itm['id']] = $itm;
		}

		return $result;
	}

	public static function update()
	{
		// TODO: Implement update() method.
	}

	public static function delete()
	{
		// TODO: Implement delete() method.
	}
}