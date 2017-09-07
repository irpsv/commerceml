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
		$ret = $this->document->createElement("ПакетПредложений");

		$value = $this->model->getIsOnlyChanges();
		if (!is_null($value)) {
			$value = $value ? "true" : "false";
			$ret->setAttribute("СодержитТолькоИзменения", $value);
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
				$childs = [];
				foreach ($node->childNodes as $child) {
					$childs[] = $child;
				}

				$node2 = $this->document->createElement("Владелец");
				foreach ($childs as $child) {
					$node2->appendChild($child);
				}
				$ret->appendChild($node2);
			}
		}

		$value = $this->model->getPriceTypes();
		if ($value) {
			$node = $this->document->createElement("ТипыЦен");
			foreach ($value as $item) {
				$nodeChild = (new PriceTypeParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getStores();
		if ($value) {
			$node = $this->document->createElement("Склады");
			foreach ($value as $item) {
				$nodeChild = (new StoreParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getPropertyValues();
		if ($value) {
			$node = $this->document->createElement("ЗначенияСвойств");
			foreach ($value as $item) {
				$nodeChild = (new PropertyValueParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getOffers();
		if ($value) {
			$node = $this->document->createElement("Предложения");
			foreach ($value as $item) {
				$nodeChild = (new OfferParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		return $ret;
	}
}
