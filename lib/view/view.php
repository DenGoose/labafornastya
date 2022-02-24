<?php

namespace Lib\View;

use Exception;

class ViewManager
{
	protected const VIEW_DIR = '/app/view/';

	/**
	 * @throws Exception
	 */
	public static function show(string $modelName, array $params = []): void
	{
		$pathToModel = $_SERVER['DOCUMENT_ROOT'] . self::VIEW_DIR . $modelName . '.php';

		if (!file_exists($pathToModel))
		{
			throw new Exception("Модель ${modelName} не найдена");
		}

		include $pathToModel;
	}
}