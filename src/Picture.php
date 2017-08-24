<?php

namespace irpsv\commerceml;

/**
 * ИмяФайлаКартинки
 */
class Picture
{
	protected $fileName;

	public function __construct(string $fileName)
	{
		$this->fileName = $fileName;
	}

	public function getFileName(): ?string
	{
		return $this->fileName;
	}
}
