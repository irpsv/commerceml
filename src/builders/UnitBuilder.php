<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Unit;
use irpsv\commerceml\helpers\DocumentHelper;

class UnitBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Unit();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Единица");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Коэффициент");
		if ($value) {
			$ret->setCoeff($value->nodeValue);
		}

		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДополнительныеДанные");
		// if ($value) {
		// 	foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "ЗначениеРеквизита") as $item) {
		// 		$requisite = (new RequisiteValueBuilder($item))->build();
		// 		if ($requisite) {
		// 			$ret->addAdditionalRequisite($requisite);
		// 		}
		// 	}
		// }

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
