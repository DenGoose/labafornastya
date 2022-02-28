<?php

namespace App\Models;

class SalePointModel extends \Lib\Model\BaseModel
{

	public static function create()
	{
		// TODO: Implement create() method.
	}

	public static function read(): array
	{
		$ob = self::query('select * from sale_points');

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