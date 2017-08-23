<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\docs\Catalog;
use irpsv\commerceml\docs\Document;
use irpsv\commerceml\docs\Classifier;
use irpsv\commerceml\docs\OfferPackage;
use irpsv\commerceml\docs\CommerceInfo;
use irpsv\commerceml\docs\UpdatesOfferPackage;
use irpsv\commerceml\docs\builders\CmlDocumentBuilder;

class CmlDocumentBuilderTest extends TestCase
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
		// некорректный документ
		if (is_null($doc)) {
			throw new \Exception("Вернулось ничего, атата");
		}
		// ЭД КоммерческаяИнформация
		else if ($doc instanceof CommerceInfo) {
			$this->assertInstanceOf(CommerceInfo::class, $doc);
		}
		// ЭД Документ
		else if ($doc instanceof Document) {
			$this->assertInstanceOf(Document::class, $doc);
		}
		// ЭД Классификатор
		else if ($doc instanceof Classifier) {
			$this->assertInstanceOf(Classifier::class, $doc);
		}
		// ЭД Каталог
		else if ($doc instanceof Catalog) {
			$this->assertInstanceOf(Catalog::class, $doc);
		}
		// ЭД ПакетПредложений
		else if ($doc instanceof OfferPackage) {
			$this->assertInstanceOf(OfferPackage::class, $doc);
		}
		// ЭД ИзмененияПакетаПредложений
		else if ($doc instanceof UpdatesOfferPackage) {
			$this->assertInstanceOf(UpdatesOfferPackage::class, $doc);
		}
		else {
			throw new \Exception("Вернулся неизвестный тип ". get_class($doc));
		}
    }
}
