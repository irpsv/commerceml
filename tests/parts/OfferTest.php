<?php

namespace tests\parts;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\Offer;
use irpsv\commerceml\parsers\OfferParser;
use irpsv\commerceml\builders\OfferBuilder;

class OfferTest extends TestCase
{
	public function getXml()
	{
		return trim('
		<Предложение>
			<Ид>05e26d70-01e4-11dc-a411-12355d80a2d1</Ид>
			<Наименование>Стол обеденный</Наименование>
			<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
			<Цены>
				<Цена>
					<ИдТипаЦены>05e26d70-01e4-11dc-a411-222222222222</ИдТипаЦены>
					<ЦенаЗаЕдиницу>321</ЦенаЗаЕдиницу>
				</Цена>
				<Цена>
					<Представление>987 EUR за 1 шт</Представление>
					<ИдТипаЦены>05e26d70-01e4-11dc-a411-333333333333</ИдТипаЦены>
					<ЦенаЗаЕдиницу>987</ЦенаЗаЕдиницу>
					<Валюта>EUR</Валюта>
					<Единица>шт</Единица>
					<Коэффициент>1</Коэффициент>
					<МинКоличество>5</МинКоличество>
					<ИдКаталога>05e26d70-01e4-11dc-a411-444444444444</ИдКаталога>
				</Цена>
			</Цены>
			<Количество>456</Количество>
			<Склад>
				<ИдСклада>05e26d70-01e4-11dc-a411-666666666666</ИдСклада>
			</Склад>
			<Склад>
				<ИдСклада>05e26d70-01e4-11dc-a411-555555555555</ИдСклада>
				<КоличествоНаСкладе>123</КоличествоНаСкладе>
			</Склад>
		</Предложение>
		');
	}

	public function getDom()
	{
		$dom = new \DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($this->getXml());
		return $dom->getElementsByTagName('Предложение')->item(0);
	}

	public function testBuilder()
	{
		$item = (new OfferBuilder($this->getDom()))->build();
		$this->assertEquals($item->getId(), "05e26d70-01e4-11dc-a411-12355d80a2d1");
		$this->assertEquals($item->getName(), "Стол обеденный");
		$this->assertEquals($item->getCount(), 456);

		$baseScale = $item->getBaseScale();
		$this->assertEquals($baseScale->getCode(), "796");
		$this->assertEquals($baseScale->getName(), "");
		$this->assertEquals($baseScale->getValue(), "шт");
		$this->assertEquals($baseScale->getFullName(), "Штука");
		$this->assertEquals($baseScale->getReduction(), "PCE");

		$prices = $item->getPrices();
		$this->assertEquals(count($prices), 2);
		$this->assertEquals($prices[0]->getPerformance(), "");
		$this->assertEquals($prices[0]->getPriceTypeId(), "05e26d70-01e4-11dc-a411-222222222222");
		$this->assertEquals($prices[0]->getPricePerOne(), "321");
		$this->assertEquals($prices[0]->getValute(), "");
		$this->assertEquals($prices[0]->getMinCount(), "");
		$this->assertEquals($prices[0]->getCatalogId(), "");
		$this->assertEquals($prices[0]->getUnit(), "");

		$stores = $item->getStoreCounts();
		$this->assertEquals(count($stores), 2);
		$this->assertEquals($stores[0]->getStoreId(), "05e26d70-01e4-11dc-a411-666666666666");
		$this->assertEquals($stores[0]->getCount(), "");

		return $item;
	}

	/**
	 * @depends testBuilder
	 */
	public function testParser($model)
	{
		$dom = new \DOMDocument();
		$node = (new OfferParser($model, $dom))->parse();
		$this->assertEquals($node->nodeValue, $this->getDom()->nodeValue);
	}
}
