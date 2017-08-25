<?php

namespace irpsv\commerceml\builders;

use irpsv\commerceml\Group;
use irpsv\commerceml\helpers\DocumentHelper;

class GroupBuilder
{
	protected $element;

	public function __construct(\DOMElement $element)
	{
		$this->element = $element;
	}

	public function build(): ?Group
	{
		$ret = new Group();

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Ид");
		if ($value) {
			$ret->setId($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Наименование");
		if ($value) {
			$ret->setName($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Описание");
		if ($value) {
			$ret->setDesc($value->nodeValue);
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Группы");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Группа") as $group) {
				$ret->addGroup(
					(new GroupBuilder($group))->build()
				);
			}
		}

		$value = DocumentHelper::findFirstLevelChildsByTagNameOne($this->element, "Свойства");
		if ($value) {
			foreach (DocumentHelper::findFirstLevelChildsByTagName($value, "Свойство") as $group) {
				$ret->addProperty(
					(new PropertyBuilder($group))->build()
				);
			}
		}

		if ($ret->isEmpty()) {
			return null;
		}
		else {
			return $ret;
		}
	}
}
