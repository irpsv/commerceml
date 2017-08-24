<?php

namespace irpsv\commerceml;

/**
 * Единица измерения
 */
class Unit
{
	protected $name; // Имя единицы измерения товара по ОКЕИ.
	protected $coeff;
	protected $additionalRequisites = []; // дополнительные данные

	public function addAdditionalRequisite(RequisiteValue $value)
	{
		$this->additionalRequisites[] = $value;
	}

	public function getAdditionalRequisites(): array
	{
		return $this->additionalRequisites;
	}
}
