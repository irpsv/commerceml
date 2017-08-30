<?php

namespace tests\parts;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\AddressField;
use irpsv\commerceml\parsers\AddressFieldParser;
use irpsv\commerceml\builders\AddressFieldBuilder;

class AddressFieldTest extends TestCase
{
	public function getXml()
	{
		return trim('
		<АдресноеПоле>
			<Тип>Почтовый индекс</Тип>
			<Значение>117452</Значение>
		</АдресноеПоле>
		');
	}

	public function getDom()
	{
		$dom = new \DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($this->getXml());
		return $dom->getElementsByTagName('АдресноеПоле')->item(0);
	}

	public function testBuilder()
	{
		$dom = $this->getDom();
		$item = (new AddressFieldBuilder($dom))->build();
		$this->assertEquals($item->getType(), "Почтовый индекс");
		$this->assertEquals($item->getValue(), "117452");
		return $item;
	}

	/**
	 * @depends testBuilder
	 */
	public function testParser($model)
	{
		$dom = new \DOMDocument();
		$node = (new AddressFieldParser($model, $dom))->parse();
		$this->assertEquals($node->nodeValue, $this->getDom()->nodeValue);
	}
}
