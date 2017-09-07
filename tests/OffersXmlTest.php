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

class OneSeeOfficalTest extends TestCase
{
	public function getXmlDom()
	{
		$dom = new \DOMDocument('1.0', 'utf-8');
        $dom->preserveWhiteSpace = false;
		$dom->loadXML(file_get_contents(__DIR__."/assets/off-doc-1c/offers.xml"));
		return $dom;
	}

	public function testOffers()
	{
		$dom = $this->getXmlDom();
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

	/**
     * @depends testOffers
     */
    public function testParser($commerceInfo)
    {
		$dom = new \DOMDocument('1.0', 'utf-8');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->appendChild(
			(new CommerceInfoParser($commerceInfo, $dom))->parse()
		);
		$dom2 = $this->getXmlDom();
		$dom2->formatOutput = true;
		$this->assertEquals($dom->saveXML($dom->firstChild), $dom2->saveXML($dom2->firstChild));
    }
}
