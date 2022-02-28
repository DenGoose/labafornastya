<?php

namespace Lib\Model;

use Lib\DataBase\DB;

abstract class BaseModel
{
	public static abstract function create();

	public static abstract function read();

	public static abstract function update();

	public static abstract function delete();

	protected static function query(string $query, array $params = []): bool|\PDOStatement
	{
		$stmt = DB::getInstance()->getConnection()->prepare($query);

		$stmt->execute($params);

		return $stmt;
	}
}