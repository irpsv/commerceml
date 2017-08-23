<?php

namespace irpsv\commerceml\docs\builders;

use irpsv\commerceml\docs\CommerceInfo;

class CommerceInfoBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): CommerceInfo
	{
		$doc = new CommerceInfo();
		$doc->version = $this->element->getAttribute("ВерсияСхемы");
		$doc->datetime = new \DateTime($this->element->getAttribute("ДатаФормирования"));

		$value = $this->element->getElementsByTagName("Классификатор")->item(0);
		if ($value) {
			$doc->setClassifier(
				(new ClassifierBuilder($value))->build()
			);
		}

		$value = $this->element->getElementsByTagName("Каталог")->item(0);
		if ($value) {
			$doc->setCatalog(
				(new CatalogBuilder($value))->build()
			);
		}

		$value = $this->element->getElementsByTagName("ПакетПредложений")->item(0);
		if ($value) {
			$doc->setOfferPackage(
				(new OfferPackageBuilder($value))->build()
			);
		}

		$value = $this->element->getElementsByTagName("Документ")->item(0);
		if ($value) {
			throw new \Exception("Type of 'Документ' is coming soon");
		}

		$value = $this->element->getElementsByTagName("ИзмененияПакетаПредложений")->item(0);
		if ($value) {
			throw new \Exception("Type of 'ИзмененияПакетаПредложений' is coming soon");
		}

		return $doc;
	}
}
