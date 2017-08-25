<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\CommerceInfo;
use irpsv\commerceml\helpers\DocumentHelper;

class CommerceInfoBuilder
{
	protected $document;

	public function __construct(\DOMDocument $document)
	{
		$this->document = $document;
	}

	public function build(): ?CommerceInfo
	{
		$element = $this->document->getElementsByTagName('КоммерческаяИнформация')->item(0);
		if (!$element) {
			throw new \Exception("Root tag 'КоммерческаяИнформация' not found");
		}

		$ret = new CommerceInfo();
		$ret->setVersion(
			$element->getAttribute("ВерсияСхемы")
		);
		$ret->setDatetime(
			new \DateTime($element->getAttribute("ДатаФормирования"))
		);

		$value = $element->getElementsByTagName("Классификатор")->item(0);
		if ($value) {
			$ret->setClassifier(
				(new ClassifierBuilder($value))->build()
			);
		}

		$value = $element->getElementsByTagName("Каталог")->item(0);
		if ($value) {
			$ret->setCatalog(
				(new CatalogBuilder($value))->build()
			);
		}

		foreach ($element->getElementsByTagName("Документ") as $item) {
			$ret->addDocument(
				(new DocumentBuilder($item))->build()
			);
		}

		$value = $element->getElementsByTagName("ПакетПредложений")->item(0);
		if ($value) {
			$ret->setOfferPackage(
				(new OfferPackageBuilder($value))->build()
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
