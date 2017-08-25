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
use irpsv\commerceml\builders\CommerceInfoBuilder;

class OneSeeOfficalTest extends TestCase
{
	public function getXmlDom(string $name)
	{
		$dom = new \DOMDocument;
		$dom->loadXML(file_get_contents(__DIR__."/assets/off-doc-1c/{$name}.xml"));
		return $dom;
	}

	public function testImport()
	{
		$dom = $this->getXmlDom('import');
		$commerceInfo = (new CommerceInfoBuilder($dom))->build();

		$this->assertEquals($commerceInfo->getVersion(), "2.04");
		$this->assertEquals($commerceInfo->getDatetime()->format('Y-m-d\TH:i:s'), "2008-01-09T18:13:34");
		$this->assertEmpty($commerceInfo->getOfferPackage());
		$this->assertEmpty($commerceInfo->getDocuments());
		$this->assertNotNull($commerceInfo->getCatalog());
		$this->assertNotNull($commerceInfo->getClassifier());

		return $commerceInfo;
	}

	/**
	 * @depends testImport
	 */
	public function testImportClassifisier($commerceInfo)
	{
		$classifier = $commerceInfo->getClassifier();
		$this->assertEquals($classifier->getId(), "bd72d8f9-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($classifier->getName(), "Классификатор (Каталог товаров)");
		$this->assertEmpty($classifier->getDesc());
		$this->assertEmpty($classifier->getProperties());
		$this->assertEmpty($classifier->getPriceTypes());
		$this->assertNotNull($classifier->getOwner());
		$this->assertNotNull($classifier->getGroups());

		return $classifier;
	}

	/**
	 * @depends testImportClassifisier
	 */
	public function testImportClassifisierOwner($classifier)
	{
		$owner = $classifier->getOwner();
		$this->assertEquals($owner->getId(), "bd72d900-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($owner->getName(), "Торговый дом \"Комплексный\"");
		$this->assertEmpty($owner->getComment());
		$this->assertEmpty($owner->getAddress());
		$this->assertEmpty($owner->getContacts());
		$this->assertEmpty($owner->getRepresentatives());
		$this->assertEmpty($owner->getRequisitiesIndividual());

		$requisities = $owner->getRequisitiesOrganisation();
		$this->assertEquals($requisities->getName(), "ЗАО \"Торговый дом Комплексный\"");
		$this->assertEquals($requisities->getInn(), "0056123412");
		$this->assertEquals($requisities->getKpp(),	"567892222");
		$this->assertEmpty($requisities->getActivity());
		$this->assertEmpty($requisities->getEgrpo());
		$this->assertEmpty($requisities->getOkved());
		$this->assertEmpty($requisities->getOkdp());
		$this->assertEmpty($requisities->getOkopf());
		$this->assertEmpty($requisities->getOkfs());
		$this->assertEmpty($requisities->getOkpo());
		$this->assertEmpty($requisities->getDateRegister());
		$this->assertEmpty($requisities->getHead());

		$address = $requisities->getAddress();
		$this->assertEquals($address->getPerformance(), "117452, Москва г, Москва, Симферопольский б-р, дом № 78, корпус 1");
		$this->assertEmpty($address->getComment());

		$addressFields = $address->getAddressFields();
		$addressFieldsTests = [
			[
				'type' => "Почтовый индекс",
				'value' => "117452",
			],
			[
				'type' => "Регион",
				'value' => "Москва г",
			],
			[
				'type' => "Населенный пункт",
				'value' => "Москва",
			],
			[
				'type' => "Улица",
				'value' => "Симферопольский б-р",
			],
			[
				'type' => "Дом",
				'value' => 78,
			],
			[
				'type' => "Корпус",
				'value' => 1,
			],
		];
		$this->assertEquals(count($addressFields), 6);
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

		$scores = $requisities->getScores();
		$this->assertEquals(count($scores), 1);
		$this->assertEquals($scores[0]->getNumber(), "40702810600023341231");
		$this->assertEmpty($scores[0]->getComment());
		$this->assertEmpty($scores[0]->getBankCorrespondent());

		$bank = $scores[0]->getBank();
		$this->assertEquals($bank->getScore(), "30101810900000000292");
		$this->assertEquals($bank->getName(), "ОАО КБ \"ФУНДАМЕНТ-БАНК\"");
		$this->assertEquals($bank->getBik(), "044599292");
		$this->assertEmpty($bank->getContacts());
		$this->assertEmpty($bank->getSwift());

		$bankAddress = $bank->getAddress();
		$this->assertEquals($bankAddress->getPerformance(), ", ");
		$this->assertEmpty($bankAddress->getComment());
		$this->assertEmpty($bankAddress->getAddressFields());
	}

	/**
	 * @depends testImportClassifisier
	 */
	public function testImportClassifisierGroups($classifier)
	{
		$groups = $classifier->getGroups();
		$this->assertEquals(count($groups), 1);
		$this->assertEquals($groups[0]->getId(), "05e26d6f-01e4-11dc-a411-00055d80a2d1");
		$this->assertEquals($groups[0]->getName(), "Мебель");
		$this->assertEmpty($groups[0]->getDesc());
		$this->assertEmpty($groups[0]->getProperties());
		$this->assertEmpty($groups[0]->getGroups());
	}

	/**
	 * @depends testImport
	 */
	public function testImportCatalog($commerceInfo)
	{
		$catalog = $commerceInfo->getCatalog();
		$this->assertEquals($catalog->getIsOnlyChanges(), false);
		$this->assertEquals($catalog->getId(), "bd72d8f9-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($catalog->getClassifierId(), "bd72d8f9-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($catalog->getName(), "Каталог товаров");
		$this->assertEmpty($catalog->getDesc());
		$this->assertNotNull($catalog->getOwner());
		$this->assertNotNull($catalog->getProducts());

		return $catalog;
	}

	/**
	 * @depends testImportCatalog
	 */
	public function testImportCatalogOwner($catalog)
	{
		$owner = $catalog->getOwner();
		$this->assertEquals($owner->getId(), "bd72d900-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($owner->getName(), "Торговый дом \"Комплексный\"");
		$this->assertEmpty($owner->getComment());
		$this->assertEmpty($owner->getAddress());
		$this->assertEmpty($owner->getContacts());
		$this->assertEmpty($owner->getRepresentatives());
		$this->assertEmpty($owner->getRequisitiesIndividual());

		$requisities = $owner->getRequisitiesOrganisation();
		$this->assertEquals($requisities->getName(), "ЗАО \"Торговый дом Комплексный\"");
		$this->assertEquals($requisities->getInn(), "0056123412");
		$this->assertEquals($requisities->getKpp(),	"567892222");
		$this->assertEmpty($requisities->getActivity());
		$this->assertEmpty($requisities->getEgrpo());
		$this->assertEmpty($requisities->getOkved());
		$this->assertEmpty($requisities->getOkdp());
		$this->assertEmpty($requisities->getOkopf());
		$this->assertEmpty($requisities->getOkfs());
		$this->assertEmpty($requisities->getOkpo());
		$this->assertEmpty($requisities->getDateRegister());
		$this->assertEmpty($requisities->getHead());

		$address = $requisities->getAddress();
		$this->assertEquals($address->getPerformance(), "117452, Москва г, Москва, Симферопольский б-р, дом № 78, корпус 1");
		$this->assertEmpty($address->getComment());

		$addressFields = $address->getAddressFields();
		$addressFieldsTests = [
			[
				'type' => "Почтовый индекс",
				'value' => "117452",
			],
			[
				'type' => "Регион",
				'value' => "Москва г",
			],
			[
				'type' => "Населенный пункт",
				'value' => "Москва",
			],
			[
				'type' => "Улица",
				'value' => "Симферопольский б-р",
			],
			[
				'type' => "Дом",
				'value' => 78,
			],
			[
				'type' => "Корпус",
				'value' => 1,
			],
		];
		$this->assertEquals(count($addressFields), 6);
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

		$scores = $requisities->getScores();
		$this->assertEquals(count($scores), 1);
		$this->assertEquals($scores[0]->getNumber(), "40702810600023341231");
		$this->assertEmpty($scores[0]->getComment());
		$this->assertEmpty($scores[0]->getBankCorrespondent());

		$bank = $scores[0]->getBank();
		$this->assertEquals($bank->getScore(), "30101810900000000292");
		$this->assertEquals($bank->getName(), "ОАО КБ \"ФУНДАМЕНТ-БАНК\"");
		$this->assertEquals($bank->getBik(), "044599292");
		$this->assertEmpty($bank->getContacts());
		$this->assertEmpty($bank->getSwift());

		$bankAddress = $bank->getAddress();
		$this->assertEquals($bankAddress->getPerformance(), ", ");
		$this->assertEmpty($bankAddress->getComment());
		$this->assertEmpty($bankAddress->getAddressFields());
	}

	/**
	 * @depends testImportCatalog
	 */
	public function testImportCatalogProducts($catalog)
	{
		$products = $catalog->getProducts();
		$this->assertEquals(count($products), 4);

		$product = $products[0];
		$this->assertEquals($product->getId(), "05e26d70-01e4-11dc-a411-00055d80a2d1#05e26d76-01e4-11dc-a411-00055d80a2d1");
		$this->assertEquals($product->getName(), "Стол обеденный");
		$this->assertEmpty($product->getDesc());
		$this->assertEmpty($product->getBarcode());
		$this->assertEmpty($product->getArticul());
		$this->assertEmpty($product->getExcises());
		$this->assertEmpty($product->getAccessories());
		$this->assertEmpty($product->getAnalogs());
		$this->assertEmpty($product->getContragentProductId());
		$this->assertEmpty($product->getPictures());
		$this->assertEmpty($product->getVendor());
		$this->assertEmpty($product->getPropertyValues());

		$baseScale = $product->getBaseScale();
		$this->assertEquals($baseScale->getCode(), "796");
		$this->assertEquals($baseScale->getValue(), "шт");
		$this->assertEquals($baseScale->getFullName(), "Штука");
		$this->assertEquals($baseScale->getReduction(), "PCE");
		$this->assertEmpty($baseScale->getName());

		$groupsIds = $product->getGroupsIds();
		$this->assertEquals(count($groupsIds), 1);
		$this->assertEquals($groupsIds[0], "05e26d6f-01e4-11dc-a411-00055d80a2d1");

		$taxRates = $product->getTaxRates();
		$this->assertEquals(count($taxRates), 1);
		$this->assertEquals($taxRates[0]->getName(), "НДС");
		$this->assertEquals($taxRates[0]->getRate(), "18");

		$chars = $product->getProductChars();
		$this->assertEquals(count($chars), 1);
		$this->assertEquals($chars[0]->getName(), "Цвет");
		$this->assertEquals($chars[0]->getValue(), "Белый");

		$requisities = $product->getRequisiteValues();
		$this->assertEquals(count($requisities), 3);
		$this->assertEquals($requisities[0]->getName(), "ВидНоменклатуры");
		$this->assertEquals($requisities[0]->getValue(), "Товар");
		$this->assertEquals($requisities[1]->getName(), "ТипНоменклатуры");
		$this->assertEquals($requisities[1]->getValue(), "Товар");
		$this->assertEquals($requisities[2]->getName(), "Полное наименование");
		$this->assertEquals($requisities[2]->getValue(), "Стол обеденный");
	}

	public function testOffers()
	{
		$dom = $this->getXmlDom('offers');
		$commerceInfo = (new CommerceInfoBuilder($dom))->build();

		$this->assertEquals($commerceInfo->getVersion(), "2.04");
		$this->assertEquals($commerceInfo->getDatetime()->format('Y-m-d\TH:i:s'), "2008-01-09T18:13:34");
		$this->assertNotNull($commerceInfo->getOfferPackage());
		$this->assertEmpty($commerceInfo->getDocuments());
		$this->assertEmpty($commerceInfo->getCatalog());
		$this->assertEmpty($commerceInfo->getClassifier());

		return $commerceInfo;
	}

	/**
	 * @depends testOffers
	 */
	public function testOffersPackage($commerceInfo)
	{
		$offerPackage = $commerceInfo->getOfferPackage();
		$this->assertEquals($offerPackage->getId(), "bd72d8f9-55bc-11d9-848a-00112f43529a#");
		$this->assertEquals($offerPackage->getName(), "Пакет предложений");
		$this->assertEquals($offerPackage->getCatalogId(), "bd72d8f9-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($offerPackage->getClassifierId(), "bd72d8f9-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($offerPackage->getIsOnlyChanges(), false);
		$this->assertEmpty($offerPackage->getActiveFrom());
		$this->assertEmpty($offerPackage->getActiveTo());
		$this->assertEmpty($offerPackage->getDesc());
		$this->assertEmpty($offerPackage->getStores());
		$this->assertEmpty($offerPackage->getPropertyValues());

		$this->assertNotNull($offerPackage->getOwner());
		$this->assertNotNull($offerPackage->getPriceTypes(), "");
		$this->assertNotNull($offerPackage->getOffers(), "");

		return $offerPackage;
	}

	/**
	 * @depends testOffersPackage
	 */
	public function testOffersPackageOwner($offerPackage)
	{
		$owner = $offerPackage->getOwner();
		$this->assertEquals($owner->getId(), "bd72d900-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($owner->getName(), "Торговый дом \"Комплексный\"");
		$this->assertEmpty($owner->getComment());
		$this->assertEmpty($owner->getAddress());
		$this->assertEmpty($owner->getContacts());
		$this->assertEmpty($owner->getRepresentatives());
		$this->assertEmpty($owner->getRequisitiesIndividual());

		$requisities = $owner->getRequisitiesOrganisation();
		$this->assertEquals($requisities->getName(), "ЗАО \"Торговый дом Комплексный\"");
		$this->assertEquals($requisities->getInn(), "0056123412");
		$this->assertEquals($requisities->getKpp(),	"567892222");
		$this->assertEmpty($requisities->getActivity());
		$this->assertEmpty($requisities->getEgrpo());
		$this->assertEmpty($requisities->getOkved());
		$this->assertEmpty($requisities->getOkdp());
		$this->assertEmpty($requisities->getOkopf());
		$this->assertEmpty($requisities->getOkfs());
		$this->assertEmpty($requisities->getOkpo());
		$this->assertEmpty($requisities->getDateRegister());
		$this->assertEmpty($requisities->getHead());

		$address = $requisities->getAddress();
		$this->assertEquals($address->getPerformance(), "117452, Москва г, Москва, Симферопольский б-р, дом № 78, корпус 1");
		$this->assertEmpty($address->getComment());

		$addressFields = $address->getAddressFields();
		$addressFieldsTests = [
			[
				'type' => "Почтовый индекс",
				'value' => "117452",
			],
			[
				'type' => "Регион",
				'value' => "Москва г",
			],
			[
				'type' => "Населенный пункт",
				'value' => "Москва",
			],
			[
				'type' => "Улица",
				'value' => "Симферопольский б-р",
			],
			[
				'type' => "Дом",
				'value' => 78,
			],
			[
				'type' => "Корпус",
				'value' => 1,
			],
		];
		$this->assertEquals(count($addressFields), 6);
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

		$scores = $requisities->getScores();
		$this->assertEquals(count($scores), 1);
		$this->assertEquals($scores[0]->getNumber(), "40702810600023341231");
		$this->assertEmpty($scores[0]->getComment());
		$this->assertEmpty($scores[0]->getBankCorrespondent());

		$bank = $scores[0]->getBank();
		$this->assertEquals($bank->getScore(), "30101810900000000292");
		$this->assertEquals($bank->getName(), "ОАО КБ \"ФУНДАМЕНТ-БАНК\"");
		$this->assertEquals($bank->getBik(), "044599292");
		$this->assertEmpty($bank->getContacts());
		$this->assertEmpty($bank->getSwift());

		$bankAddress = $bank->getAddress();
		$this->assertEquals($bankAddress->getPerformance(), ", ");
		$this->assertEmpty($bankAddress->getComment());
		$this->assertEmpty($bankAddress->getAddressFields());
	}

	/**
	 * @depends testOffersPackage
	 */
	public function testOffersPackagePriceTypes($offerPackage)
	{
		$priceTypes = $offerPackage->getPriceTypes();
		$this->assertEquals(count($priceTypes), 4);
		$this->assertEquals($priceTypes[0]->getId(), "cbcf495d-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($priceTypes[0]->getName(), "Оптовая");
		$this->assertEmpty($priceTypes[0]->getDesc());

		$valute = $priceTypes[0]->getValute();
		$this->assertEquals($valute->getCode(), "USD");

		$tax = $priceTypes[0]->getTax();
		$this->assertEquals($tax->getName(), "НДС");
		$this->assertEquals($tax->getIsAccounted(), false);
		$this->assertEquals($tax->getIsExcise(), false);

		$this->assertEquals($priceTypes[1]->getTax()->getIsAccounted(), true);
	}

	/**
	 * @depends testOffersPackage
	 */
	public function testOffersPackageOffers($offerPackage)
	{
		$offers = $offerPackage->getOffers();
		$this->assertEquals(count($offers), 2);

		$offer = $offers[0];
		$this->assertEquals($offer->getId(), "05e26d70-01e4-11dc-a411-00055d80a2d1#05e26d76-01e4-11dc-a411-00055d80a2d1");
		$this->assertEquals($offer->getName(), "Стол обеденный");
		$this->assertEmpty($offer->getDesc());
		$this->assertEmpty($offer->getBarcode());
		$this->assertEmpty($offer->getArticul());
		$this->assertEmpty($offer->getExcises());
		$this->assertEmpty($offer->getAccessories());
		$this->assertEmpty($offer->getAnalogs());
		$this->assertEmpty($offer->getContragentProductId());
		$this->assertEmpty($offer->getPictures());
		$this->assertEmpty($offer->getVendor());
		$this->assertEmpty($offer->getPropertyValues());

		$this->assertEquals($offer->getCount(), 0);

		$prices = $offer->getPrices();
		$this->assertEquals(count($prices), 4);
		$this->assertEquals($prices[0]->getPerformance(), "4 USD за шт");
		$this->assertEquals($prices[0]->getPriceTypeId(), "bd72d8fc-55bc-11d9-848a-00112f43529a");
		$this->assertEquals($prices[0]->getPricePerOne(), "4");
		$this->assertEquals($prices[0]->getValute()->getCode(), "USD");
		$this->assertEmpty($prices[0]->getMinCount());
		$this->assertEmpty($prices[0]->getCatalogId());

		$unit = $prices[0]->getUnit();
		$this->assertEquals($unit->getName(), "шт");
		$this->assertEquals($unit->getCoeff(), 1);
		$this->assertEmpty($unit->getAdditionalRequisites());

		$this->assertEmpty($offer->getStoreCounts());
		$this->assertEmpty($offer->getGroupsIds());
		$this->assertEmpty($offer->getTaxRates());
		$this->assertEmpty($offer->getProductChars());
		$this->assertEmpty($offer->getRequisiteValues());

		$baseScale = $offer->getBaseScale();
		$this->assertEquals($baseScale->getCode(), "796");
		$this->assertEquals($baseScale->getValue(), "шт");
		$this->assertEquals($baseScale->getFullName(), "Штука");
		$this->assertEquals($baseScale->getReduction(), "PCE");
		$this->assertEmpty($baseScale->getName());
	}

	public function testOrders()
	{
		$dom = $this->getXmlDom('orders');
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
}
