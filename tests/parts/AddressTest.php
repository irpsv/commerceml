<?php

namespace tests\parts;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\Address;
use irpsv\commerceml\parsers\AddressParser;
use irpsv\commerceml\builders\AddressBuilder;

class AddressTest extends TestCase
{
	public function getXml()
	{
		return trim('
		<?xml version="1.0" encoding="UTF-8"?>
		<Адрес>
			<Представление>117452, Москва г, Москва, Симферопольский б-р, дом № 78, корпус 1</Представление>
			<Комментарий>Произвольный_комментарий</Комментарий>
			<АдресноеПоле>
				<Тип>Почтовый индекс</Тип>
				<Значение>117452</Значение>
			</АдресноеПоле>
			<АдресноеПоле>
				<Тип>Регион</Тип>
				<Значение>Москва г</Значение>
			</АдресноеПоле>
			<АдресноеПоле>
				<Тип>Населенный пункт</Тип>
				<Значение>Москва</Значение>
			</АдресноеПоле>
			<АдресноеПоле>
				<Тип>Улица</Тип>
				<Значение>Симферопольский б-р</Значение>
			</АдресноеПоле>
			<АдресноеПоле>
				<Тип>Дом</Тип>
				<Значение>78</Значение>
			</АдресноеПоле>
			<АдресноеПоле>
				<Тип>Корпус</Тип>
				<Значение>1</Значение>
			</АдресноеПоле>
		</Адрес>
		');
	}

	public function getDom()
	{
		$dom = new \DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($this->getXml());
		return $dom->getElementsByTagName('Адрес')->item(0);
	}

	public function testBuilder()
	{
		$dom = $this->getDom();
		$item = (new AddressBuilder($dom))->build();
		$this->assertEquals($item->getPerformance(), "117452, Москва г, Москва, Симферопольский б-р, дом № 78, корпус 1");
		$this->assertEquals($item->getComment(), "Произвольный_комментарий");

		$fields = $item->getAddressFields();
		$this->assertEquals(count($fields), 6);
		$this->assertEquals($fields[0]->getType(), "Почтовый индекс");
		$this->assertEquals($fields[0]->getValue(), "117452");

		return $item;
	}

	/**
	 * @depends testBuilder
	 */
	public function testParser($model)
	{
		$dom = new \DOMDocument('1.0', 'utf-8');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->appendChild(
			(new AddressParser($model, $dom))->parse()
		);
		$dom2 = new \DOMDocument('1.0', 'utf-8');
		$dom2->preserveWhiteSpace = false;
		$dom2->formatOutput = true;
		$dom2->loadXML($this->getXml());
		$this->assertEquals($dom->saveXML($dom->firstChild), $dom2->saveXML($dom2->firstChild));
	}
}
