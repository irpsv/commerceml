<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use irpsv\commerceml\builders\CommerceInfoBuilder;

class OneSeeOfficalTest extends TestCase
{
	public function getImportXmlDom()
	{
		$dom = new \DOMDocument;
		$dom->loadXML(file_get_contents(__DIR__.'/assets/off-doc-1c/import.xml'));
		return $dom;
	}

	public function testImport()
	{
		$dom = $this->getImportXmlDom();
		$commerceInfo = (new CommerceInfoBuilder($dom))->build();

		$this->assertEquals($commerceInfo->getVersion(), "2.04");
		$this->assertEquals($commerceInfo->getDatetime()->format('Y-m-d\TH:i:s'), "2008-01-09T18:13:34");
		$this->assertEmpty($commerceInfo->getOfferPackage());

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
		$this->assertInstanceOf(\irpsv\commerceml\RequisitiesOrganisation::class, $requisities);
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
		$this->assertInstanceOf(\irpsv\commerceml\Address::class, $address);
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
		$this->assertInstanceOf(\irpsv\commerceml\Bank::class, $bank);
		$this->assertEquals($bank->getScore(), "30101810900000000292");
		$this->assertEquals($bank->getName(), "ОАО КБ \"ФУНДАМЕНТ-БАНК\"");
		$this->assertEquals($bank->getBik(), "044599292");
		$this->assertEmpty($bank->getContacts());
		$this->assertEmpty($bank->getSwift());

		$bankAddress = $bank->getAddress();
		$this->assertInstanceOf(\irpsv\commerceml\Address::class, $bankAddress);
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
	}

	public function testOffers()
	{

	}

	public function testOrders()
	{

	}
}
