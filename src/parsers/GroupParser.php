<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Group;

class GroupParser
{
	protected $model;
	protected $document;

	public function __construct(Group $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("Группа");

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

		$value = $this->model->getDesc();
		if ($value) {
			$node = $this->document->createElement("Описание", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getProperties();
		if ($value) {
			$node = $this->document->createElement("Свойства");
			foreach ($value as $item) {
				$nodeChild = (new PropertyParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
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

		return $ret;
	}
}
