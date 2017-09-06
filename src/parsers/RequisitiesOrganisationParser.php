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

	public function parse(\DOMElement $ret): \DOMElement
	{
		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ОфициальноеНаименование", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ЮридическийАдрес", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ИНН", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("КПП", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ОсновнойВидДеятельности", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ЕГРПО", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ОКВЭД", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ОКДП", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ОКОПФ", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ОКФС", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ОКПО", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("ДатаРегистрации", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = (new OrganisationHeadParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getFullName();
		if ($value) {
			$node = $this->document->createElement("РасчетныеСчета");
			foreach ($value as $item) {
				$node = (new ScoreParser($item, $this->document))->parse();
				if ($node) {
					$ret->appendChild($node);
				}
			}
		}

		return $ret;
	}
}
