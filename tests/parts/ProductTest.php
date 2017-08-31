<?php

namespace tests\parts;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\Product;
use irpsv\commerceml\parsers\ProductParser;
use irpsv\commerceml\builders\ProductBuilder;

class ProductTest extends TestCase
{
	public function getXml()
	{
		return trim('
		<Товар>
			<Ид>05e26d70-01e4-11dc-a411-00055d80a2d1</Ид>
			<Штрихкод>9832723894729834</Штрихкод>
			<Артикул>Стол обеденный 123</Артикул>
			<Наименование>Стол обеденный</Наименование>
			<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
			<Группы>
				<Ид>05e26d6f-01e4-11dc-a411-00055d80a2d1</Ид>
			</Группы>
			<Описание>Какое_то_описание</Описание>
			<Картинка>Путь_до_файла1</Картинка>
			<Картинка>Путь_до_файла2</Картинка>
			<ЗначенияСвойств>
				<ЗначенияСвойства>
					<Ид>05e26d70-01e4-11dc-0000-00055d80a2d1</Ид>
					<Наименование>Количество заказов</Наименование>
					<Значение>123</Значение>
				</ЗначенияСвойства>
			</ЗначенияСвойств>
			<СтавкиНалогов>
				<СтавкаНалога>
					<Наименование>НДС</Наименование>
					<Ставка>18</Ставка>
				</СтавкаНалога>
			</СтавкиНалогов>
			<ХарактеристикиТовара>
				<ХарактеристикаТовара>
					<Наименование>Цвет</Наименование>
					<Значение>Белый</Значение>
				</ХарактеристикаТовара>
				<ХарактеристикаТовара>
					<Ид>05e26d70-2222-1111-0000-00055d80a2d1</Ид>
					<Наименование>Размер</Наименование>
					<Значение>S</Значение>
				</ХарактеристикаТовара>
			</ХарактеристикиТовара>
			<ЗначенияРеквизитов>
				<ЗначениеРеквизита>
					<Наименование>ВидНоменклатуры</Наименование>
					<Значение>Товар</Значение>
				</ЗначениеРеквизита>
				<ЗначениеРеквизита>
					<Наименование>ТипНоменклатуры</Наименование>
					<Значение>Товар</Значение>
				</ЗначениеРеквизита>
				<ЗначениеРеквизита>
					<Наименование>Полное наименование</Наименование>
					<Значение>Стол обеденный</Значение>
				</ЗначениеРеквизита>
			</ЗначенияРеквизитов>
		</Товар>
		');
	}

	public function getDom()
	{
		$dom = new \DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($this->getXml());
		return $dom->getElementsByTagName('Товар')->item(0);
	}

	public function testBuilder()
	{
		$item = (new ProductBuilder($this->getDom()))->build();
		$this->assertEquals($item->getId(), "05e26d70-01e4-11dc-a411-00055d80a2d1");
		$this->assertEquals($item->getName(), "Стол обеденный");
		$this->assertEquals($item->getDesc(), "Какое_то_описание");
		$this->assertEquals($item->getBarcode(), "9832723894729834");
		$this->assertEquals($item->getArticul(), "Стол обеденный 123");

		$baseScale = $item->getBaseScale();
		$this->assertEquals($baseScale->getCode(), "796");
		$this->assertEquals($baseScale->getName(), "");
		$this->assertEquals($baseScale->getValue(), "шт");
		$this->assertEquals($baseScale->getFullName(), "Штука");
		$this->assertEquals($baseScale->getReduction(), "PCE");

		$this->assertEquals($item->getContragentProductId(), "");

		$groups = $item->getGroupsIds();
		$this->assertEquals(count($groups), 1);
		$this->assertEquals($groups[0], "05e26d6f-01e4-11dc-a411-00055d80a2d1");

		$pictures = $item->getPictures();
		$this->assertEquals(count($pictures), 2);
		$this->assertEquals($pictures[0]->getFileName(), "Путь_до_файла1");
		$this->assertEquals($pictures[1]->getFileName(), "Путь_до_файла2");

		$this->assertEquals($item->getVendor(), "");

		$propertyValues = $item->getPropertyValues();
		$this->assertEquals(count($propertyValues), 1);
		$this->assertEquals($propertyValues[0]->getId(), "05e26d70-01e4-11dc-0000-00055d80a2d1");
		$this->assertEquals($propertyValues[0]->getName(), "Количество заказов");
		$this->assertEquals($propertyValues[0]->getValue(), "123");

		$this->assertEmpty($item->getExcises());
		$this->assertEmpty($item->getAccessories());
		$this->assertEmpty($item->getAnalogs());

		$chars = $item->getProductChars();
		$this->assertEquals(count($chars), 2);
		$this->assertEquals($chars[0]->getId(), "");
		$this->assertEquals($chars[0]->getName(), "Цвет");
		$this->assertEquals($chars[0]->getValue(), "Белый");

		$requisities = $item->getRequisiteValues();
		$this->assertEquals(count($requisities), 3);
		$this->assertEquals($requisities[0]->getName(), "ВидНоменклатуры");
		$this->assertEquals($requisities[0]->getValue(), "Товар");

		return $item;
	}

	/**
	 * @depends testBuilder
	 */
	public function testParser($model)
	{
		$dom = new \DOMDocument();
		$node = (new ProductParser($model, $dom))->parse();
		$this->assertEquals($node->nodeValue, $this->getDom()->nodeValue);
	}
}
