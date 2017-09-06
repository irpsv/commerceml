<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Score;

class ScoreParser
{
	protected $model;
	protected $document;

	public function __construct(Score $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("РасчетныйСчет");

		$value = $this->model->getNumber();
		if ($value) {
			$node = $this->document->createElement("НомерСчета", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getBank();
		if ($value) {
			$node = (new BankParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getBankCorrespondent();
		if ($value) {
			$node = (new BankParser($value, $this->document))->parse();
			if ($node) {
				$node = $this->document->createElement("БанкКорреспондент", $node->nodeValue);
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getComment();
		if ($value) {
			$node = $this->document->createElement("Комментарий", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
