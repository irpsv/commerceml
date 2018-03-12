<?php

namespace irpsv\commerceml;

/**
 * Код валюты по международному классификатору валют (ISO 4217).
 * Если не указана, то используется валюта установленная для данного типа цен
 */
class Valute
{
	protected $code;

	public function __construct(string $code)
	{
		$this->code = $code;
	}

	public function getCode()
	{
		return $this->code;
	}
}
