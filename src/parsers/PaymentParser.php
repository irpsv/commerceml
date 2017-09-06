<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Payment;

class PaymentParser
{
	protected $model;
	protected $document;

	public function __construct(Payment $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse(): \DOMElement
	{
		$ret = $this->document->createElement("Оплата");

		$value = $this->model->getDocumentNumber();
		if ($value) {
			$node = $this->document->createElement("НомерДокумента", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getTransactionNumber();
		if ($value) {
			$node = $this->document->createElement("НомерТранзакции", $value);
			$ret->appendChild($node);
		}


		$value = $this->model->getDate();
		if ($value) {
			$node = $this->document->createElement("ДатаОплаты", $value->format('Y-m-d H:i:s'));
			$ret->appendChild($node);
		}

		$value = $this->model->getAmount();
		if ($value) {
			$node = $this->document->createElement("СуммаОплаты", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getType();
		if ($value) {
			$node = $this->document->createElement("СпособОплаты", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getTypeId();
		if ($value) {
			$node = $this->document->createElement("ИдСпособаОплаты", $value);
			$ret->appendChild($node);
		}

		return $ret;
	}
}
