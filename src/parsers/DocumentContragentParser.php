<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\DocumentContragent;

class DocumentContragentParser
{
	protected $model;
	protected $document;

	public function __construct(DocumentContragent $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = (new ContragentParser($this->model, $this->document))->parse();

		$value = $this->model->getRole();
		if ($value) {
			$node = $this->document->createElement("Роль", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getScore();
		if ($value) {
			$node = (new ScoreParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getStore();
		if ($value) {
			$node = (new StoreParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		return $ret;
	}
}
