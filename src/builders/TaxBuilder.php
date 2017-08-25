<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Tax;
use irpsv\commerceml\helpers\DocumentHelper;

class TaxBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?Tax
	{
		$ret = new Tax();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "УчтеноВСумме");
		if ($value) {
			$ret->setIsAccounted(
				$value->nodeValue == "true"
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Акциз");
		if ($value) {
			$ret->setIsExcise(
				$value->nodeValue == "true"
			);
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
