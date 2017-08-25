<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Valute;
use irpsv\commerceml\Document;
use irpsv\commerceml\helpers\DocumentHelper;

class DocumentBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?Document
	{
		$ret = new Document();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Номер");
		if ($value) {
			$ret->setNumber($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Дата");
		if ($value) {
			$datetime = $value->nodeValue;
			$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Время");
			if ($value) {
				$datetime .= " {$value->nodeValue}";
			}
			$ret->setDatetime(
				new \DateTime($datetime)
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ХозОперация");
		if ($value) {
			$ret->setOperation($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Роль");
		if ($value) {
			$ret->setRole($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Валюта");
		if ($value) {
			$ret->setValute(
				new Valute($value->nodeValue)
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Курс");
		if ($value) {
			$ret->setCourse($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Сумма");
		if ($value) {
			$ret->setAmount($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Контрагенты");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Контрагент") as $item) {
				$agent = (new DocumentContragentBuilder($item))->build();
				if ($agent) {
					$ret->addContragent($agent);
				}
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Оплаты");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Оплата") as $item) {
				$payment = (new PaymentBuilder($item))->build();
				if ($payment) {
					$ret->addPayment($payment);
				}
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "СрокПлатежа");
		if ($value) {
			$ret->setPaymentDate(
				new \DateTime($value->nodeValue)
			);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Комментарий");
		if ($value) {
			$ret->setComment($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Налоги");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Налог") as $item) {
				$tax = (new DocumentTaxBuilder($item))->build();
				if ($tax) {
					$ret->addTax($tax);
				}
			}
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Скидки");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Скидка") as $item) {
				$discount = (new DiscountBuilder($item))->build();
				if ($discount) {
					$ret->addDiscount($discount);
				}
			}
		}

		// $value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ДопРасходы");
		// if ($value) {
		// 	$ret->setName($value->nodeValue);
		// }

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Склады");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Склад") as $item) {
				$store = (new StoreBuilder($item))->build();
				if ($store) {
					$ret->addStore($store);
				}
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Товары");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Товар") as $item) {
				$product = (new DocumentProductBuilder($item))->build();
				if ($product) {
					$ret->addProduct($product);
				}
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "ЗначенияРеквизитов");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "ЗначениеРеквизита") as $item) {
				$requisite = (new RequisiteValueBuilder($item))->build();
				if ($requisite) {
					$ret->addRequisiteValue($requisite);
				}
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
