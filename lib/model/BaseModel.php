<?php

namespace Lib\Model;

abstract class BaseModel
{
	public static abstract function create();

	public static abstract function read();

	public static abstract function update();

	public static abstract function delete();
}