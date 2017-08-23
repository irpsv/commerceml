<?php

namespace tests;

use PHPUnit\Framework\TestCase;

class CommerceInfoTest extends TestCase
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
		$doc = new CommerceInfo();
		$doc->version; // ВерсияСхемы
		$doc->datetime; // ДатаФормирования
		$catalog = $doc->getCatalog(); // Каталог
		$document = $doc->getDocument(); // Документ
		$classifier = $doc->getClassifier(); // Классификатор
		$offerPackage = $doc->getOfferPackage(); // ПакетПредложений
		$updatesOfferPackage = $doc->getUpdatesOfferPackage(); // ИзмененияПакетаПредложений
    }
}
