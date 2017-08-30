<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\BaseScale;

class BaseScaleParser
{
	protected $model;
	protected $document;

	public function __construct(BaseScale $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("БазоваяЕдиница");

		$value = $this->model->getCode();
		if ($value) {
			$ret->setAttribute("Код", $value);
		}

		$value = $this->model->getName();
		if ($value) {
			$ret->setAttribute("НаименованиеКраткое", $value);
		}

		$value = $this->model->getValue();
		if ($value) {
			$ret->nodeValue = $value;
		}

		$value = $this->model->getFullName();
		if ($value) {
			$ret->setAttribute("НаименованиеПолное", $value);
		}

		$value = $this->model->getReduction();
		if ($value) {
			$ret->setAttribute("МеждународноеСокращение", $value);
		}

		return $ret;
	}
}
