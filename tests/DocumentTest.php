<?php

namespace tests;

use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
	public function getDocument()
	{
		$xml = file_get_contents(__DIR__.'/assets/import.xml');
		$dom = new \DOMDocument;
		$dom->loadXML($xml);
		return $dom;
	}

	public function testBase()
	{
		return;
		$doc = new Document();
		$doc->getId(); // ИдентфикаторГлобальныйТип
		$doc->getNumber(); // НомерТип
		$doc->getDateTime(); // ДатаТип
		$doc->getOperation(); // ХозОперацияТип
		$doc->getRole(); // РольТип
		$doc->getValute(); // ВалютаТип
		$doc->getCourse(); // Курс - КоэффициентТип
		$doc->getSum(); // СуммаТип
		$doc->getAgents(); // КонтрагентДляДокумента
		$doc->getPayment(); // ОплатаСайт
		$doc->getPaymentDateTime(); // ДатаТип
		$doc->getComment(); // КомментарийТип
		$doc->getTaxations(); // НалогДляДокумента
		$doc->getDiscounts(); // Скидка
		$doc->getCosts(); // ДопРасход
		$doc->getStores(); // Склад
		$doc->getProducts(); // ТоварДляДокумента
		$doc->getProps(); // ЗначениеРеквизита
		$doc->getSigners(); // Подписант
	}
}
