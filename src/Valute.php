<?php

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

	public function getCode(): string
	{
		return $this->code;
	}
}