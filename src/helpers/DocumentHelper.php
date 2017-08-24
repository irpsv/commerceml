<?php

namespace irpsv\commerceml\helpers;

class DocumentHelper
{
	public static function findFirstLevelChildsByTagName($element, string $tagName)
	{
		$ret = [];
		$childs = $element->childNodes;
		foreach ($childs as $item) {
			if ($item->nodeName == $tagName) {
				$ret[] = $item;
			}
		}
		return $ret;
	}

	public static function findFirstLevelChildsByTagNameOne($element, string $tagName)
	{
		$childs = $element->childNodes;
		foreach ($childs as $item) {
			if ($item->nodeName == $tagName) {
				return $item;
			}
		}
		return null;
	}
}
