<?php

namespace tests\parts;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\Document;
use irpsv\commerceml\parsers\DocumentParser;
use irpsv\commerceml\builders\DocumentBuilder;

class DocumentTest extends TestCase
{
	public function getXml()
	{
		return trim('
		<Документ>
			<Ид>36</Ид>
			<Номер>36</Номер>
			<Дата>2007-10-30</Дата>
			<Время>15:19:27</Время>
			<ХозОперация>Заказ товара</ХозОперация>
			<Роль>Продавец</Роль>
			<Валюта>руб</Валюта>
			<Курс>1</Курс>
			<Сумма>6734.47</Сумма>
			<Контрагенты>
				<Контрагент>
					<Ид>1#admin# admin </Ид>
					<Наименование>admin</Наименование>
					<ПолноеНаименование>admin</ПолноеНаименование>
					<Фамилия>Иванов</Фамилия>
					<Имя>admin</Имя>
					<АдресРегистрации>
						<Представление>ггг</Представление>
						<АдресноеПоле>
							<Тип>Почтовый индекс</Тип>
							<Значение>1111</Значение>
						</АдресноеПоле>
						<АдресноеПоле>
							<Тип>Улица</Тип>
							<Значение>ггг</Значение>
						</АдресноеПоле>
					</АдресРегистрации>
					<Контакты/>
					<Представители>
						<Представитель>
							<Контрагент>
								<Ид>b342955a9185c40132d4c1df6b30af2f</Ид>
								<Наименование>admin</Наименование>
								<Отношение>Контактное лицо</Отношение>
							</Контрагент>
						</Представитель>
					</Представители>
					<Роль>Покупатель</Роль>
				</Контрагент>
			</Контрагенты>
			<Оплаты>
				<Оплата>
					<НомерДокумента>984</НомерДокумента>
					<НомерТранзакции>123</НомерТранзакции>
					<ДатаОплаты>2007-10-30 12:12:12</ДатаОплаты>
					<СуммаОплаты>1234</СуммаОплаты>
					<СпособОплаты>наличные</СпособОплаты>
					<ИдСпособаОплаты>b342955a9185c40132d4c1df6b3012345</ИдСпособаОплаты>
				</Оплата>
			</Оплаты>
			<Комментарий/>
			<Товары>
				<Товар>
					<Ид>ORDER_DELIVERY</Ид>
					<Наименование>Доставка заказа</Наименование>
					<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
					<ЗначенияРеквизитов>
						<ЗначениеРеквизита>
							<Наименование>ВидНоменклатуры</Наименование>
							<Значение>Услуга</Значение>
						</ЗначениеРеквизита>
						<ЗначениеРеквизита>
							<Наименование>ТипНоменклатуры</Наименование>
							<Значение>Услуга</Значение>
						</ЗначениеРеквизита>
					</ЗначенияРеквизитов>
					<ЦенаЗаЕдиницу>340.00</ЦенаЗаЕдиницу>
					<Количество>1.00</Количество>
					<Сумма>340.00</Сумма>
				</Товар>
				<Товар>
					<Ид>dee6e19a-55bc-11d9-848a-00112f43529a</Ид>
					<Наименование>Телевизор "JVC"</Наименование>
					<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
					<ЗначенияРеквизитов>
						<ЗначениеРеквизита>
							<Наименование>ВидНоменклатуры</Наименование>
							<Значение>Товар</Значение>
						</ЗначениеРеквизита>
						<ЗначениеРеквизита>
							<Наименование>ТипНоменклатуры</Наименование>
							<Значение>Товар</Значение>
						</ЗначениеРеквизита>
					</ЗначенияРеквизитов>
					<ИдКаталога>bd72d8f9-55bc-11d9-848a-00112f43529a</ИдКаталога>
					<ЦенаЗаЕдиницу>6394.47</ЦенаЗаЕдиницу>
					<Количество>1.00</Количество>
					<Сумма>6394.47</Сумма>
				</Товар>
			</Товары>
			<ЗначенияРеквизитов>
				<ЗначениеРеквизита>
					<Наименование>Метод оплаты</Наименование>
					<Значение>Наличный расчет</Значение>
				</ЗначениеРеквизита>
				<ЗначениеРеквизита>
					<Наименование>Заказ оплачен</Наименование>
					<Значение>false</Значение>
				</ЗначениеРеквизита>
				<ЗначениеРеквизита>
					<Наименование>Доставка разрешена</Наименование>
					<Значение>false</Значение>
				</ЗначениеРеквизита>
				<ЗначениеРеквизита>
					<Наименование>Отменен</Наименование>
					<Значение>false</Значение>
				</ЗначениеРеквизита>
				<ЗначениеРеквизита>
					<Наименование>Финальный статус</Наименование>
					<Значение>false</Значение>
				</ЗначениеРеквизита>
				<ЗначениеРеквизита>
					<Наименование>Статус заказа</Наименование>
					<Значение>[N] Принят</Значение>
				</ЗначениеРеквизита>
				<ЗначениеРеквизита>
					<Наименование>Дата изменения статуса</Наименование>
					<Значение>2007-10-30 15:19:27</Значение>
				</ЗначениеРеквизита>
			</ЗначенияРеквизитов>
		</Документ>
		');
	}

	public function getDom()
	{
		$dom = new \DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXML($this->getXml());
		return $dom->getElementsByTagName('Документ')->item(0);
	}

	public function testBuilder()
	{
		$dom = $this->getDom();
		$item = (new DocumentBuilder($dom))->build();
		$this->assertEquals($item->getId(), "36");
		$this->assertEquals($item->getNumber(), "36");
		$this->assertEquals($item->getDatetime()->format('Y-m-d H:i:s'), "2007-10-30 15:19:27");
		$this->assertEquals($item->getOperation(), "Заказ товара");
		$this->assertEquals($item->getRole(), "Продавец");
		$this->assertEquals($item->getValute()->getCode(), "руб");
		$this->assertEquals($item->getCourse(), 1);
		$this->assertEquals($item->getAmount(), 6734.47);
		$this->assertEquals($item->getPaymentDate(), "");
		$this->assertEquals($item->getComment(), "");

		$products = $item->getProducts();
		$this->assertEquals(count($products), 2);
		$this->assertEquals($products[0]->getId(), "ORDER_DELIVERY");
		$this->assertEquals($products[0]->getName(), "Доставка заказа");
		$this->assertEquals($products[0]->getCatalogId(), "");
		$this->assertEquals($products[0]->getClassifierId(), "");
		$this->assertEquals($products[0]->getPricePerOne(), "340.00");
		$this->assertEquals($products[0]->getCount(), "1");
		$this->assertEquals($products[0]->getAmount(), "340.00");
		$this->assertEquals($products[0]->getUnit(), "");
		$this->assertEquals($products[0]->getCountry(), "");
		$this->assertEquals($products[0]->getGtd(), "");

		$requisities = $products[0]->getRequisiteValues();
		$this->assertEquals(count($requisities), 2);
		$this->assertEquals($requisities[0]->getName(), "ВидНоменклатуры");
		$this->assertEquals($requisities[0]->getValue(), "Услуга");
		$this->assertEquals($requisities[1]->getName(), "ТипНоменклатуры");
		$this->assertEquals($requisities[1]->getValue(), "Услуга");

		$payments = $item->getPayments();
		$this->assertEquals(count($payments), 1);
		$this->assertEquals($payments[0]->getDocumentNumber(), "984");
		$this->assertEquals($payments[0]->getTransactionNumber(), "123");
		$this->assertEquals($payments[0]->getDate()->format('Y-m-d H:i:s'), "2007-10-30 12:12:12");
		$this->assertEquals($payments[0]->getAmount(), "1234");
		$this->assertEquals($payments[0]->getType(), "наличные");
		$this->assertEquals($payments[0]->getTypeId(), "b342955a9185c40132d4c1df6b3012345");

		$contragents = $item->getContragents();
		$this->assertEquals(count($contragents), 1);
		$this->assertEquals($contragents[0]->getId(), "1#admin# admin ");
		$this->assertEquals($contragents[0]->getRole(), "Покупатель");
		$this->assertEquals($contragents[0]->getScore(), "");
		$this->assertEquals($contragents[0]->getStore(), "");

		$taxes = $item->getTaxes();
		$this->assertEquals(count($taxes), 0);

		$discounts = $item->getDiscounts();
		$this->assertEquals(count($discounts), 0);

		$stores = $item->getStores();
		$this->assertEquals(count($stores), 0);

		$requisities = $item->getRequisiteValues();
		$this->assertEquals(count($requisities), 7);
		$this->assertEquals($requisities[0]->getName(), "Метод оплаты");
		$this->assertEquals($requisities[0]->getValue(), "Наличный расчет");
		$this->assertEquals($requisities[3]->getName(), "Отменен");
		$this->assertEquals($requisities[3]->getValue(), "false");
		$this->assertEquals($requisities[6]->getName(), "Дата изменения статуса");
		$this->assertEquals($requisities[6]->getValue(), "2007-10-30 15:19:27");

		return $item;
	}

	/**
	 * @depends testBuilder
	 */
	public function testParser($model)
	{
		$dom = new \DOMDocument();
		$node = (new DocumentParser($model, $dom))->parse();
		$this->assertEquals($node->nodeValue, $this->getDom()->nodeValue);
	}
}
