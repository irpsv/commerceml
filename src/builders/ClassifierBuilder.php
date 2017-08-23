<?php

namespace irpsv\commerceml\docs\builders;

use irpsv\commerceml\docs\Classifier;
use irpsv\commerceml\types\builders\GroupBuilder;
use irpsv\commerceml\types\builders\ContragentBuilder;
use irpsv\commerceml\types\builders\PropertyBuilder;
use irpsv\commerceml\types\builders\PriceTypeBuilder;

class ClassifierBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): Classifier
	{
		$ret = new Classifier();
		$ret->id = $this->element->getElementsByTagName("Ид")->item(0)->nodeValue;
		$ret->name = $this->element->getElementsByTagName("Наименование")->item(0)->nodeValue;

		$node = $this->element->getElementsByTagName("Владелец")->item(0);
		$ret->setOwner(
			(new ContragentBuilder($node))->build()
		);

		$node = $this->element->getElementsByTagName("Описание")->item(0);
		if ($node) {
			$ret->desc = $node->nodeValue;
		}

		$nodes = $this->element->getElementsByTagName("Группы");
		foreach ($nodes as $node) {
			$ret->addGroup(
				(new GroupBuilder($node))->build()
			);
		}

		$nodes = $this->element->getElementsByTagName("Свойства");
		foreach ($nodes as $node) {
			$ret->addProperty(
				(new PropertyBuilder($node))->build()
			);
		}

		$nodes = $this->element->getElementsByTagName("ТипыЦен");
		foreach ($nodes as $node) {
			$ret->addPriceType(
				(new PriceTypeBuilder($node))->build()
			);
		}

		return $ret;
	}
}
