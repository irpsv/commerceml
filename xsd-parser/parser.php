<?php

class ClassType
{
    public $className;
    public $extendClass;
    public $properties = [];
}

class Property
{
    public $name;
    public $type;
    public $isArray = false;
}

$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->loadXML(file_get_contents(__DIR__.'/CML209.XSD.xml'));
$xpath = new DOMXPath($xml);

$types = [];
foreach ($xpath->query('*') as $item) {
    $name = $item->getAttribute('name');
    $types[$name] = $item;
}

function parsingComplexType($node, $xpath) {
    $ret = new ClassType();
    $ret->className = $node->getAttribute('name');

    $childs = $xpath->query('*', $node);
    foreach ($childs as $child) {
        switch ($child->tagName) {
            case "xsd:annotation":
                // pass
                break;

            case "xsd:attribute":
                $ret->properties[] = parsingAttribute($child, $xpath);

            case "xsd:sequence":
                $ret->properties = array_merge(
                    $ret->properties,
                    parsingSequence($child, $xpath)
                );
                break;

            default:
                var_dump(__LINE__, $child->tagName);
                die();
        }
    }
    return $ret;
}

function parsingAttribute($node, $xpath) {
    $ret = new Property();
    $ret->name = $node->getAttribute('name');
    $ret->type = $node->getAttribute('type');
    if (!$ret->type) {
        var_dump(__LINE__, $node);
        die();
    }
    return $ret;
}

function parsingSequence($node, $xpath) {
    $ret = [];
    $childs = $xpath->query('*', $node);
    foreach ($childs as $child) {
        switch ($child->tagName) {
            case "xsd:element":
                $item = new Property();
                $item->name = $child->getAttribute('name');
                $item->type = $child->getAttribute('type');
                $item->isArray = (bool) $child->getAttribute('maxOccurs');
                $ret[] = $item;
                break;

            default:
                var_dump(__LINE__, $child->tagName);
                die();
        }
    }
    return $ret;
}

function parsingElement($node, $xpath) {
    var_dump(__LINE__, $node);
    die();
    return $node;
}

function parsingGroup($node, $xpath) {
    var_dump(__LINE__, $node);
    die();
    return $node;
}

function parsingSimpleType($node, $xpath) {
    var_dump(__LINE__, $node);
    die();
    return $node;
}

foreach ($types as & $type) {
    switch ($type->tagName) {
        case "xsd:complexType":
            $type = parsingComplexType($type, $xpath);
            break;

        case "xsd:element":
            $type = parsingElement($type, $xpath);
            break;

        case "xsd:group":
            $type = parsingGroup($type, $xpath);
            break;

        case "xsd:simpleType":
            $type = parsingSimpleType($type, $xpath);
            break;

        default:
            var_dump($type->tagName);
            die();
    }
}
echo count($types);
