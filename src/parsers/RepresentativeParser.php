<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Representative;

class RepresentativeParser
{
	protected $model;
	protected $document;

	public function __construct(Representative $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("Представитель");

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

		$value = $this->model->getRequisitiesIndividual();
		if ($value) {
			$node = (new RequisitiesIndividualParser($value, $this->document))->parse($ret);
		}

		$value = $this->model->getRequisitiesOrganisation();
		if ($value) {
			$node = (new RequisitiesOrganisationParser($value, $this->document))->parse($ret);
		}

		$value = $this->model->getComment();
		if ($value) {
			$node = $this->document->createElement("Комментарий", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getAddress();
		if ($value) {
			$node = (new AddressParser($value, $this->document))->parse();
			if ($node) {
				$ret->appendChild($node);
			}
		}

		$value = $this->model->getContacts();
		if ($value) {
			$node = $this->document->createElement("Контакты");
			foreach ($value as $item) {
				$nodeChild = (new ContactParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getRelation();
		if ($value) {
			$node = $this->document->createElement("Отношение", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
