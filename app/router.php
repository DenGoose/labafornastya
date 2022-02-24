<?php

\Lib\Http\Router::getInstance()->run( // поменять page на controller
	'/',
	'IndexController',
	'get'
);
