<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\BaseScale;
use irpsv\commerceml\helpers\DocumentHelper;

class BaseScaleBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?BaseScale
	{
		$ret = new BaseScale();

		$value = $this->element->nodeValue;
		if ($value) {
			$ret->setValue($value);
		}

		$value = $this->element->getAttribute("Код");
		if ($value) {
			$ret->setCode($value);
		}

		$value = $this->element->getAttribute("НаименованиеКраткое");
		if ($value) {
			$ret->setName($value);
		}

		$value = $this->element->getAttribute("НаименованиеПолное");
		if ($value) {
			$ret->setFullName($value);
		}

		$value = $this->element->getAttribute("МеждународноеСокращение");
		if ($value) {
			$ret->setReduction($value);
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
