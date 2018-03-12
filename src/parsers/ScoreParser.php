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

	public function parse()
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
				$childs = [];
				foreach ($node->childNodes as $child) {
					$childs[] = $child;
				}

				$node2 = $this->document->createElement("БанкКорреспондент");
				foreach ($childs as $child) {
					$node2->appendChild($child);
				}
				$ret->appendChild($node2);
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
