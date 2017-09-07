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

class ImportXmlTest extends TestCase
{
    public function getXmlDom()
    {
        $dom = new \DOMDocument;
        $dom->preserveWhiteSpace = false;
        $dom->loadXML(file_get_contents(__DIR__."/assets/off-doc-1c/import.xml"));
        return $dom;
    }

    public function testImport()
    {
        $dom = $this->getXmlDom();
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

    /**
     * @depends testImport
     */
    public function testParser($commerceInfo)
    {
        $dom = new \DOMDocument();
		$node = (new CommerceInfoParser($commerceInfo, $dom))->parse();
		$this->assertEquals($node->nodeValue, $this->getXmlDom()->textContent);
    }
}
