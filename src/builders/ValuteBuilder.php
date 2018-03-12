<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Valute;
use irpsv\commerceml\helpers\DocumentHelper;

class ValuteBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		return new Valute(
			$this->element->nodeValue
		);
	}
}
