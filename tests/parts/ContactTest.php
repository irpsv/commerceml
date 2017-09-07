<?php

namespace tests\parts;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\Contact;
use irpsv\commerceml\parsers\ContactParser;
use irpsv\commerceml\builders\ContactBuilder;

class ContactTest extends TestCase
{
	public function getXml()
	{
		return trim('
		<?xml version="1.0" encoding="UTF-8"?>
		<Контакт>
			<Тип>Телефон мобильный</Тип>
			<Значение>+79638889944</Значение>
			<Комментарий>Произвольный_комментарий</Комментарий>
		</Контакт>
		');
	}

	public function getDom()
	{
		$dom = new \DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($this->getXml());
		return $dom->getElementsByTagName('Контакт')->item(0);
	}

	public function testBuilder()
	{
		$dom = $this->getDom();
		$item = (new ContactBuilder($dom))->build();
		$this->assertEquals($item->getType(), Contact::TYPE_PHONE_MOBILE);
		$this->assertEquals($item->getValue(), "+79638889944");
		$this->assertEquals($item->getComment(), "Произвольный_комментарий");

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
			(new ContactParser($model, $dom))->parse()
		);
		$dom2 = new \DOMDocument('1.0', 'utf-8');
		$dom2->preserveWhiteSpace = false;
		$dom2->formatOutput = true;
		$dom2->loadXML($this->getXml());
		$this->assertEquals($dom->saveXML($dom->firstChild), $dom2->saveXML($dom2->firstChild));
	}
}
