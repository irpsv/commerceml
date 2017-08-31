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
			<ХозОперация>Заказ товара</ХозОперация>
			<Роль>Продавец</Роль>
			<Валюта>руб</Валюта>
			<Курс>1</Курс>
			<Сумма>6734.47</Сумма>
			<Контрагенты>
				<Контрагент>
					<Ид>1#admin# admin </Ид>
					<Наименование>admin</Наименование>
					<Роль>Покупатель</Роль>
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
								<Отношение>Контактное лицо</Отношение>
								<Ид>b342955a9185c40132d4c1df6b30af2f</Ид>
								<Наименование>admin</Наименование>
							</Контрагент>
						</Представитель>
					</Представители>
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
			<Время>15:19:27</Время>
			<Комментарий/>
			<Товары>
				<Товар>
					<Ид>ORDER_DELIVERY</Ид>
					<Наименование>Доставка заказа</Наименование>
					<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
					<ЦенаЗаЕдиницу>340.00</ЦенаЗаЕдиницу>
					<Количество>1</Количество>
					<Сумма>340.00</Сумма>
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
				</Товар>
				<Товар>
					<Ид>dee6e19a-55bc-11d9-848a-00112f43529a</Ид>
					<ИдКаталога>bd72d8f9-55bc-11d9-848a-00112f43529a</ИдКаталога>
					<Наименование>Телевизор &amp;quot;JVC&amp;quot;</Наименование>
					<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
					<ЦенаЗаЕдиницу>6394.47</ЦенаЗаЕдиницу>
					<Количество>1.00</Количество>
					<Сумма>6394.47</Сумма>
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
		$this->assertEquals($products[0]->getId(), "");
		$this->assertEquals($products[0]->getName(), "");
		$this->assertEquals($products[0]->getCatalogId(), "");
		$this->assertEquals($products[0]->getClassifierId(), "");
		$this->assertEquals($products[0]->getPricePerOne(), "");
		$this->assertEquals($products[0]->getCount(), "");
		$this->assertEquals($products[0]->getAmount(), "");
		$this->assertEquals($products[0]->getUnit(), "");
		$this->assertEquals($products[0]->getCountry(), "");
		$this->assertEquals($products[0]->getGtd(), "");

		$payments = $item->getPayments();
		$this->assertEquals(count($payments), 6);
		$this->assertEquals($payments[0]->getDocumentNumber(), "");
		$this->assertEquals($payments[0]->getTransactionNumber(), "");
		$this->assertEquals($payments[0]->getDate(), "");
		$this->assertEquals($payments[0]->getAmount(), "");
		$this->assertEquals($payments[0]->getType(), "");
		$this->assertEquals($payments[0]->getTypeId(), "");

		$contragents = $item->getContragents();
		$this->assertEquals(count($contragents), 6);
		$this->assertEquals($contragents[0]->getType(), "");

		$contragents = $item->getRequisiteValues();
		$this->assertEquals(count($contragents), 6);
		$this->assertEquals($contragents[0]->getType(), "");

		$contragents = $item->getStores();
		$this->assertEquals(count($contragents), 6);
		$this->assertEquals($contragents[0]->getType(), "");

		$contragents = $item->getDiscounts();
		$this->assertEquals(count($contragents), 6);
		$this->assertEquals($contragents[0]->getType(), "");

		$contragents = $item->getTaxes();
		$this->assertEquals(count($contragents), 6);
		$this->assertEquals($contragents[0]->getType(), "");

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
