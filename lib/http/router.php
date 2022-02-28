<?php

namespace Lib\Http;

use Lib\Controller\BaseController;

class Router
{
	private static ?Router $instance = null;

	protected string $url = '';
	protected array $get = [];
	protected array $post = [];
	protected string $method = '';

	public function __construct()
	{
		$this->url = explode('?', $_SERVER['REQUEST_URI'])[0];
		$this->get = $_GET;
		$this->post = $_POST;
		$this->method = mb_strtolower($_SERVER['REQUEST_METHOD']);
	}

	public static function getInstance(): ?Router
	{
		if (!self::$instance)
		{
			self::$instance = new Router();
		}

		return self::$instance;
	}

	/**
	 * @throws \Exception
	 */
	public function run(string $url, string $controllerName, string $action, string $requestMethod = 'get', array $params = [])
	{
		if ($url === $this->url && $requestMethod == $this->method)
		{
			$className = '\\App\\Controller\\' . $controllerName;
			$params['request'] = [
				'get' => $this->get,
				'post' => $this->post,
				'url' => $this->url
			];

			if (!class_exists($className))
			{
				throw new \Exception("Контроллер ${controllerName} не найден");
			}

			/** @var BaseController $ob */
			$ob = new $className($params);

			if (mb_strlen($action) && method_exists($ob, $action))
			{
				$ob->$action();
			}
		}
	}
}