<?php

namespace irpsv\commerceml;

abstract class Model
{
	public function isEmpty()
	{
		$class = new \ReflectionClass($this);
		foreach ($class->getProperties() as $property) {
			$property->setAccessible(true);
			$value = $property->getValue($this);
			if (!empty($value)) {
				return false;
			}
		}
		return true;
	}
}
