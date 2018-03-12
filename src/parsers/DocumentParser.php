<?php

namespace irpsv\commerceml\parsers;

use irpsv\commerceml\Document;

class DocumentParser
{
	protected $model;
	protected $document;

	public function __construct(Document $model, \DOMDocument $document)
	{
		$this->model = $model;
		$this->document = $document;
	}

	public function parse()
	{
		$ret = $this->document->createElement("Документ");

		$value = $this->model->getId();
		if ($value) {
			$node = $this->document->createElement("Ид", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getNumber();
		if ($value) {
			$node = $this->document->createElement("Номер", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getDatetime();
		if ($value) {
			$node = $this->document->createElement("Дата", $value->format('Y-m-d'));
			$ret->appendChild($node);

			$node = $this->document->createElement("Время", $value->format('H:i:s'));
			$ret->appendChild($node);
		}

		$value = $this->model->getOperation();
		if ($value) {
			$node = $this->document->createElement("ХозОперация", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getRole();
		if ($value) {
			$node = $this->document->createElement("Роль", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getValute();
		if ($value) {
			$node = $this->document->createElement("Валюта", $value->getCode());
			$ret->appendChild($node);
		}

		$value = $this->model->getCourse();
		if ($value) {
			$node = $this->document->createElement("Курс", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getAmount();
		if ($value) {
			$node = $this->document->createElement("Сумма", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getContragents();
		if ($value) {
			$node = $this->document->createElement("Контрагенты");
			foreach ($value as $item) {
				$nodeChild = (new DocumentContragentParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getPayments();
		if ($value) {
			$node = $this->document->createElement("Оплаты");
			foreach ($value as $item) {
				$nodeChild = (new PaymentParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getPaymentDate();
		if ($value) {
			$node = $this->document->createElement("СрокПлатежа", $value->format('Y-m-d H:i:s'));
			$ret->appendChild($node);
		}

		$value = $this->model->getComment();
		if ($value) {
			$node = $this->document->createElement("Комментарий", $value);
			$ret->appendChild($node);
		}

		$value = $this->model->getTaxes();
		if ($value) {
			$node = $this->document->createElement("Налоги");
			foreach ($value as $item) {
				$nodeChild = (new DocumentTaxParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getDiscounts();
		if ($value) {
			$node = $this->document->createElement("Скидки");
			foreach ($value as $item) {
				$nodeChild = (new DiscountParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getStores();
		if ($value) {
			$node = $this->document->createElement("Склады");
			foreach ($value as $item) {
				$nodeChild = (new StoreParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getProducts();
		if ($value) {
			$node = $this->document->createElement("Товары");
			foreach ($value as $item) {
				$nodeChild = (new DocumentProductParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		$value = $this->model->getRequisiteValues();
		if ($value) {
			$node = $this->document->createElement("ЗначенияРеквизитов");
			foreach ($value as $item) {
				$nodeChild = (new RequisiteValueParser($item, $this->document))->parse();
				if ($nodeChild) {
					$node->appendChild($nodeChild);
				}
			}
			$ret->appendChild($node);
		}

		return $ret;
	}
}
