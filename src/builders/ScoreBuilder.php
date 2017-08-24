<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Score;
use irpsv\commerceml\helpers\DocumentHelper;

class ScoreBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?Score
	{
		$ret = new Score();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "НомерСчета");
		if ($value) {
			$ret->setNumber($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Комментарий");
		if ($value) {
			$ret->setComment($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Банк");
		if ($value) {
			$bank = (new BankBuilder($value))->build();
			if ($bank) {
				$ret->setBank($bank);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "БанкКорреспондент");
		if ($value) {
			$bank = (new BankBuilder($value))->build();
			if ($bank) {
				$ret->setBankCorrespondent($bank);
			}
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
