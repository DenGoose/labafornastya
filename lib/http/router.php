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

	public function add(string $url, string $controllerName, string $method = 'get')
	{
		if ($url === $this->url && $method == $this->method)
		{
			$className = '\\App\\Controller\\' . $controllerName;
			$params = [
				'request' => [
					'get' => $this->get,
					'post' => $this->post,
					'url' => $this->url
				]
			];

			/** @var BaseController $ob */
			$ob = new $className($params);

			$ob->exec();
		}
	}
}