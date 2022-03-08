<?php

namespace Lib\Model;

use Lib\DataBase\DB;

abstract class BaseModel
{
	public static abstract function create($fields);

	public static abstract function read($filter, $params);

	public static abstract function update($set, $filter, $fields);

	public static abstract function delete($filter, $fields);

	protected static function query(string $query, array $params = []): bool|\PDOStatement
	{
		$stmt = DB::getInstance()->getConnection()->prepare($query);

		$stmt->execute($params);

		return $stmt;
	}
}