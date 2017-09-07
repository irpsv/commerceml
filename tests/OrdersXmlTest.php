<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\Bank;
use irpsv\commerceml\Address;
use irpsv\commerceml\Product;
use irpsv\commerceml\BaseScale;
use irpsv\commerceml\TaxRate;
use irpsv\commerceml\ProductChar;
use irpsv\commerceml\RequisiteValue;
use irpsv\commerceml\RequisitiesOrganisation;
use irpsv\commerceml\parsers\CommerceInfoParser;
use irpsv\commerceml\builders\CommerceInfoBuilder;

class OrdersXmlTest extends TestCase
{
	public function getXmlDom()
	{
		$dom = new \DOMDocument;
		$dom->preserveWhiteSpace = false;
		$dom->loadXML(file_get_contents(__DIR__."/assets/off-doc-1c/orders.xml"));
		return $dom;
	}

	public function testOrders()
	{
		$dom = $this->getXmlDom();
		$commerceInfo = (new CommerceInfoBuilder($dom))->build();

		$this->assertEquals($commerceInfo->getVersion(), "2.03");
		$this->assertEquals($commerceInfo->getDatetime()->format('Y-m-d\TH:i:s'), "2007-10-30T00:00:00");
		$this->assertEmpty($commerceInfo->getOfferPackage());
		$this->assertNotNull($commerceInfo->getDocuments());
		$this->assertEmpty($commerceInfo->getCatalog());
		$this->assertEmpty($commerceInfo->getClassifier());

		return $commerceInfo;
	}

	/**
	 * @depends testOrders
	 */
	public function testOrdersDocument($commerceInfo)
	{
		$documents = $commerceInfo->getDocuments();
		$this->assertEquals(count($documents), 3);

		$document = $documents[0];
		$this->assertEquals($document->getId(), "36");
		$this->assertEquals($document->getNumber(), "36");
		$this->assertEquals($document->getDatetime()->format("Y-m-d\TH:i:s"), "2007-10-30T15:19:27");
		$this->assertEquals($document->getOperation(), "Заказ товара");
		$this->assertEquals($document->getRole(), "Продавец");
		$this->assertEquals($document->getValute()->getCode(), "руб");
		$this->assertEquals($document->getCourse(), 1);
		$this->assertEquals($document->getAmount(), 6734.47);
		$this->assertEmpty($document->getTaxes());
		$this->assertEmpty($document->getDiscounts());
		$this->assertEmpty($document->getStores());
		$this->assertEmpty($document->getPaymentDate());
		$this->assertEmpty($document->getComment());
		$this->assertEmpty($document->getPayments());

		$this->assertNotNull($document->getContragents());
		$this->assertNotNull($document->getProducts());
		$this->assertNotNull($document->getRequisiteValues());

		return $document;
	}

	/**
	 * @depends testOrdersDocument
	 */
	public function testOrdersDocumentAgents($document)
	{
		$agents = $document->getContragents();
		$this->assertEquals(count($agents), 1);

		$agent = $agents[0];
		$this->assertEquals($agent->getId(), "1#admin# admin ");
		$this->assertEquals($agent->getName(), "admin");
		$this->assertEquals($agent->getRole(), "Покупатель");
		$this->assertEmpty($agent->getComment());
		$this->assertEmpty($agent->getAddress());
		$this->assertEmpty($agent->getScore());
		$this->assertEmpty($agent->getStore());
		$this->assertEmpty($agent->getContacts());
		$this->assertEmpty($agent->getRequisitiesOrganisation());

		$requisities = $agent->getRequisitiesIndividual();
		$this->assertEquals($requisities->getFirstName(), "admin");
		$this->assertEquals($requisities->getSecondName(), "Иванов");
		$this->assertEquals($requisities->getFullName(), "admin");
		$this->assertEmpty($requisities->getThirdName());
		$this->assertEmpty($requisities->getPassport());
		$this->assertEmpty($requisities->getAppeal());
		$this->assertEmpty($requisities->getBirthday());
		$this->assertEmpty($requisities->getBirthplace());
		$this->assertEmpty($requisities->getSex());
		$this->assertEmpty($requisities->getInn());
		$this->assertEmpty($requisities->getKpp());
		$this->assertEmpty($requisities->getWorkPlace());
		$this->assertNotNull($requisities->getAddress());

		$address = $requisities->getAddress();
		$this->assertEquals($address->getPerformance(), "ггг");
		$this->assertEmpty($address->getComment());
		$this->assertNotNull($address->getAddressFields());

		$addressFields = $address->getAddressFields();
		$addressFieldsTests = [
			[
				'type' => "Почтовый индекс",
				'value' => "1111",
			],
			[
				'type' => "Улица",
				'value' => "ггг",
			],
		];
		$this->assertEquals(count($addressFields), 2);
		for ($i=0; $i<count($addressFields); $i++) {
			$this->assertEquals(
				$addressFields[$i]->getValue(),
				$addressFieldsTests[$i]['value']
			);
			$this->assertEquals(
				$addressFields[$i]->getType(),
				$addressFieldsTests[$i]['type']
			);
		}

		$represntatives = $agent->getRepresentatives();
		$this->assertEquals(count($represntatives), 1);

		$rep = $represntatives[0];
		$this->assertEquals($rep->getId(), "b342955a9185c40132d4c1df6b30af2f");
		$this->assertEquals($rep->getName(), "admin");
		$this->assertEquals($rep->getRelation(), "Контактное лицо");
		$this->assertEmpty($rep->getRequisitiesIndividual());
		$this->assertEmpty($rep->getRequisitiesOrganisation());
		$this->assertEmpty($rep->getComment());
		$this->assertEmpty($rep->getAddress());
		$this->assertEmpty($rep->getContacts());
	}

	/**
	 * @depends testOrdersDocument
	 */
	public function testOrdersDocumentProducts($document)
	{
		$products = $document->getProducts();
		$this->assertEquals(count($products), 2);

		$product = $products[0];
		$this->assertEquals($product->getId(), "ORDER_DELIVERY");
		$this->assertEquals($product->getName(), "Доставка заказа");
		$this->assertEmpty($product->getDesc());
		$this->assertEmpty($product->getCatalogId());
		$this->assertEmpty($product->getClassifierId());
		$this->assertEquals($product->getPricePerOne(), 340);
		$this->assertEquals($product->getCount(), 1);
		$this->assertEquals($product->getAmount(), 340.00);
		$this->assertEmpty($product->getUnit());
		$this->assertEmpty($product->getCountry());
		$this->assertEmpty($product->getGtd());
		$this->assertEmpty($product->getBarcode());
		$this->assertEmpty($product->getArticul());
		$this->assertEmpty($product->getExcises());
		$this->assertEmpty($product->getAccessories());
		$this->assertEmpty($product->getAnalogs());
		$this->assertEmpty($product->getContragentProductId());
		$this->assertEmpty($product->getPictures());
		$this->assertEmpty($product->getVendor());
		$this->assertEmpty($product->getGroupsIds());
		$this->assertEmpty($product->getTaxRates());
		$this->assertEmpty($product->getProductChars());
		$this->assertEmpty($product->getPropertyValues());

		$baseScale = $product->getBaseScale();
		$this->assertEquals($baseScale->getCode(), "796");
		$this->assertEquals($baseScale->getValue(), "шт");
		$this->assertEquals($baseScale->getFullName(), "Штука");
		$this->assertEquals($baseScale->getReduction(), "PCE");
		$this->assertEmpty($baseScale->getName());

		$requisities = $product->getRequisiteValues();
		$this->assertEquals(count($requisities), 2);
		$this->assertEquals($requisities[0]->getName(), "ВидНоменклатуры");
		$this->assertEquals($requisities[0]->getValue(), "Услуга");
		$this->assertEquals($requisities[1]->getName(), "ТипНоменклатуры");
		$this->assertEquals($requisities[1]->getValue(), "Услуга");
	}

	/**
	 * @depends testOrdersDocument
	 */
	public function testOrdersDocumentRequisities($document)
	{
		$requisities = $document->getRequisiteValues();
		$this->assertEquals(count($requisities), 7);
		$testValues = [
			[
				'name' => "Метод оплаты",
				'value' => "Наличный расчет",
			],
			[
				'name' => "Заказ оплачен",
				'value' => "false",
			],
			[
				'name' => "Доставка разрешена",
				'value' => "false",
			],
			[
				'name' => "Отменен",
				'value' => "false",
			],
			[
				'name' => "Финальный статус",
				'value' => "false",
			],
			[
				'name' => "Статус заказа",
				'value' => "[N] Принят",
			],
			[
				'name' => "Дата изменения статуса",
				'value' => "2007-10-30 15:19:27",
			],
		];
		for ($i=0; $i < count($testValues); $i++) {
			$this->assertEquals($requisities[$i]->getName(), $testValues[$i]['name']);
			$this->assertEquals($requisities[$i]->getValue(), $testValues[$i]['value']);
		}
	}

	/**
     * @depends testOrders
     */
    public function testParser($commerceInfo)
    {
        $dom = new \DOMDocument();
		$node = (new CommerceInfoParser($commerceInfo, $dom))->parse();
		$this->assertEquals($node->nodeValue, $this->getXmlDom()->textContent);
    }
}
