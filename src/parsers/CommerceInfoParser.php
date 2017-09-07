<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\CommerceInfo;

class CommerceInfoParser
{
	protected $model;
	protected $document;

	public function __construct(CommerceInfo $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("КоммерческаяИнформация");

		$value = $this->model->getVersion();
		if ($value) {
			$ret->setAttribute("ВерсияСхемы", $value);
		}

		$value = $this->model->getDatetime();
		if ($value) {
			$ret->setAttribute("ДатаФормирования", $value->format('Y-m-d\TH:i:s'));
		}

		$value = $this->model->getClassifier();
		if ($value) {
			$node = (new ClassifierParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getCatalog();
		if ($value) {
			$node = (new CatalogParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getOfferPackage();
		if ($value) {
			$node = (new OfferPackageParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getDocuments();
		if ($value) {
			foreach ($value as $item) {
				$item = (new DocumentParser($item, $this->document))->parse();
				$ret->appendChild($item);
			}
		}

		return $ret;
	}
}
