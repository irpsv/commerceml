<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\OfferPackage;

class OfferPackageParser
{
	protected $model;
	protected $document;

	public function __construct(OfferPackage $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("Классификатор");

		$value = $this->model->getIsOnlyChanges();
		if ($value) {
			$ret->setAttribute("СодержитТолькоИзменения", "true");
		}

		$value = $this->model->getId();
		if ($value) {
			$node = $this->document->createElement("Ид", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("Наименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getCatalogId();
		if ($value) {
			$node = $this->document->createElement("ИдКаталога", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getClassifierId();
		if ($value) {
			$node = $this->document->createElement("ИдКлассификатора", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getActiveFrom();
		if ($value) {
			$node = $this->document->createElement("ДействительноС", $value->format('Y-m-d H:i:s'));
			$ret->appendChild($node);
		}

		$value = $this->model->getActiveTo();
		if ($value) {
			$node = $this->document->createElement("ДействительноДо", $value->format('Y-m-d H:i:s'));
			$ret->appendChild($node);
		}

		$value = $this->model->getDesc();
		if ($value) {
			$node = $this->document->createElement("Описание", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getOwner();
		if ($value) {
			$node = (new ContragentParser($value, $this->document))->parse();
			if ($node) {
				$node = $this->document->createElement("Владелец", $node->nodeValue);
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getPriceTypes();
		if ($value) {
			$node = $this->document->createElement("ТипыЦен");
			foreach ($value as $item) {
				$item = (new PriceTypeParser($item, $this->document))->parse();
				if ($item) {
					$node->appendChild($item);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getStores();
		if ($value) {
			$node = $this->document->createElement("Склады");
			foreach ($value as $item) {
				$item = (new StoreParser($item, $this->document))->parse();
				if ($item) {
					$node->appendChild($item);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getPropertyValues();
		if ($value) {
			$node = $this->document->createElement("ЗначенияСвойств");
			foreach ($value as $item) {
				$item = (new PropertyValueParser($item, $this->document))->parse();
				if ($item) {
					$node->appendChild($item);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getOffers();
		if ($value) {
			$node = $this->document->createElement("Предложения");
			foreach ($value as $item) {
				$item = (new OfferParser($item, $this->document))->parse();
				if ($item) {
					$node->appendChild($item);
				}
			}
			$ret->appendChild($node);
		}

		return $ret;
	}
}
