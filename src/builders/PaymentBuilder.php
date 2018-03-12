<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Payment;
use irpsv\commerceml\helpers\DocumentHelper;

class PaymentBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build()
	{
		$ret = new Payment();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "НомерДокумента");
		if ($value) {
			$ret->setDocumentNumber($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "НомерТранзакции");
		if ($value) {
			$ret->setTransactionNumber($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДатаОплаты");
		if ($value) {
			$ret->setDate(
				new \DateTime($value->nodeValue)
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "СуммаОплаты");
		if ($value) {
			$ret->setAmount($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "СпособОплаты");
		if ($value) {
			$ret->setType($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ИдСпособаОплаты");
		if ($value) {
			$ret->setTypeId($value->nodeValue);
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
