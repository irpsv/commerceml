<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\StoreCount;

class StoreCountParser
{
	protected $model;
	protected $document;

	public function __construct(StoreCount $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("Склад");

		$value = $this->model->getStoreId();
		if ($value) {
			$node = $this->document->createElement("ИдСклада", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getCount();
		if ($value) {
			$node = $this->document->createElement("КоличествоНаСкладе", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
