<?php

namespace tests;

use PHPUnit\Framework\TestCase;

class ImportXmlTest extends TestCase
{
	public function getDocument()
	{
		$xml = file_get_contents(__DIR__.'/assets/import.xml');
		$dom = new \DOMDocument;
		$dom->loadXML($xml);
		return $dom;
	}

    public function testGeneral()
    {
		$dom = $this->getDocument();
		$doc = (new CmlDocumentBuilder($dom))->build();
		// ЭД КоммерческаяИнформация
		if ($doc instanceof CommerceInfo) {
			$doc->version; // ВерсияСхемы
			$doc->datetime; // ДатаФормирования
			$catalog = $doc->getCatalog(); // Каталог
			$document = $doc->getDocument(); // Документ
			$classifier = $doc->getClassifier(); // Классификатор
			$offerPackage = $doc->getOfferPackage(); // ПакетПредложений
			$updatesOfferPackage = $doc->getUpdatesOfferPackage(); // ИзмененияПакетаПредложений
		}
		// ЭД Документ
		else if ($doc instanceof Document) {
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
		// ЭД Классификатор
		else if ($doc instanceof Classifier) {
		}
		// ЭД Каталог
		else if ($doc instanceof Catalog) {
		}
		// ЭД ПакетПредложений
		else if ($doc instanceof OfferPackage) {
		}
		// ЭД ИзмененияПакетаПредложений
		else if ($doc instanceof UpdatesOfferPackage) {
		}
    }
}
