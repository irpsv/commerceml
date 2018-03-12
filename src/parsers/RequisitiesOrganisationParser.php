<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\RequisitiesOrganisation;

class RequisitiesOrganisationParser
{
	protected $model;
	protected $document;

	public function __construct(RequisitiesOrganisation $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(\DOMElement $ret)
	{
		$value = $this->model->getName();
		if ($value) {
			$node = $this->document->createElement("ОфициальноеНаименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getAddress();
		if ($value) {
			$node = (new AddressParser($value, $this->document))->parse();
			if ($node) {
				$childs = [];
				foreach ($node->childNodes as $child) {
					$childs[] = $child;
				}

				$node2 = $this->document->createElement("ЮридическийАдрес");
				foreach ($childs as $child) {
					$node2->appendChild($child);
				}
				$ret->appendChild($node2);
			}
		}

		$value = $this->model->getInn();
		if ($value) {
			$node = $this->document->createElement("ИНН", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getKpp();
		if ($value) {
			$node = $this->document->createElement("КПП", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getActivity();
		if ($value) {
			$node = $this->document->createElement("ОсновнойВидДеятельности", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getEgrpo();
		if ($value) {
			$node = $this->document->createElement("ЕГРПО", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getOkved();
		if ($value) {
			$node = $this->document->createElement("ОКВЭД", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getOkdp();
		if ($value) {
			$node = $this->document->createElement("ОКДП", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getOkopf();
		if ($value) {
			$node = $this->document->createElement("ОКОПФ", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getOkfs();
		if ($value) {
			$node = $this->document->createElement("ОКФС", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getOkpo();
		if ($value) {
			$node = $this->document->createElement("ОКПО", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getDateRegister();
		if ($value) {
			$node = $this->document->createElement("ДатаРегистрации", $value->format('Y-m-d H:i:s'));
			$ret->appendChild($node);
		}

		$value = $this->model->getHead();
		if ($value) {
			$node = (new OrganisationHeadParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getScores();
		if ($value) {
			$node = $this->document->createElement("РасчетныеСчета");
			foreach ($value as $item) {
				$nodeChild = (new ScoreParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		return $ret;
	}
}
