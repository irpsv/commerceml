<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Classifier;

class ClassifierParser
{
	protected $model;
	protected $document;

	public function __construct(Classifier $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("Классификатор");

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

		$value = $this->model->getDesc();
		if ($value) {
			$node = $this->document->createElement("Описание", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getGroups();
		if ($value) {
			$node = $this->document->createElement("Группы");
			foreach ($value as $item) {
				$nodeChild = (new GroupParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getProperties();
		if ($value) {
			$node = $this->document->createElement("Свойства");
			foreach ($value as $item) {
				$nodeChild = (new GroupParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
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

		return $ret;
	}
}
