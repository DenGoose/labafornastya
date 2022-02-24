<?php

namespace Lib\Controller;

abstract class BaseController
{
	public function __construct(
		protected array $params = []
	)
	{}

	public abstract function exec();
}