<?php

\Lib\Http\Router::getInstance()->add( // поменять page на controller
	'/',
	'IndexController',
	'get'
);

//\Lib\Http\Router::getInstance()->add(
//	'/test/#ID#/',
//	'test',
//	'get'
//);