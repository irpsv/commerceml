<?php

namespace tests\parts;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\Accessory;
use irpsv\commerceml\parsers\AccessoryParser;
use irpsv\commerceml\builders\AccessoryBuilder;

class AccessoryTest extends TestCase
{
	public function getXml()
	{
		return trim('
		<?xml version="1.0" encoding="UTF-8"?>
		<Комплектующее>
			<Ид>05e26d70-01e4-11dc-a411-12355d80a2d1</Ид>
			<Наименование>Стол обеденный</Наименование>
			<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
			<ИдКаталога>05e26d70-01e4-11dc-a411-00055d80a2d1</ИдКаталога>
			<ИдКлассификатора>05e26d70-01e4-11dc-a411-34234d80a2d1</ИдКлассификатора>
			<Количество>321</Количество>
		</Комплектующее>
		');
	}

	public function getDom()
	{
		$dom = new \DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($this->getXml());
		return $dom->getElementsByTagName('Комплектующее')->item(0);
	}

	public function testBuilder()
	{
		$item = (new AccessoryBuilder($this->getDom()))->build();
		$this->assertEquals($item->getId(), "05e26d70-01e4-11dc-a411-12355d80a2d1");
		$this->assertEquals($item->getName(), "Стол обеденный");
		$this->assertEquals($item->getCatalogId(), "05e26d70-01e4-11dc-a411-00055d80a2d1");
		$this->assertEquals($item->getClassifierId(), "05e26d70-01e4-11dc-a411-34234d80a2d1");
		$this->assertEquals($item->getCount(), 321);

		$baseScale = $item->getBaseScale();
		$this->assertEquals($baseScale->getCode(), "796");
		$this->assertEquals($baseScale->getName(), "");
		$this->assertEquals($baseScale->getValue(), "шт");
		$this->assertEquals($baseScale->getFullName(), "Штука");
		$this->assertEquals($baseScale->getReduction(), "PCE");

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
			(new AccessoryParser($model, $dom))->parse()
		);
		$dom2 = new \DOMDocument('1.0', 'utf-8');
		$dom2->preserveWhiteSpace = false;
		$dom2->formatOutput = true;
		$dom2->loadXML($this->getXml());
		$this->assertEquals($dom->saveXML($dom->firstChild), $dom2->saveXML($dom2->firstChild));
	}
}
