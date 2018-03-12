<?php

namespace irpsv\commerceml;

/**
 * Единица измерения
 */
class Unit extends Model
{
	protected $name; // Имя единицы измерения товара по ОКЕИ.
	protected $coeff;
	protected $additionalRequisites = []; // дополнительные данные

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setCoeff(string $value)
	{
		$this->coeff = $value;
	}

	public function getCoeff()
	{
		return $this->coeff;
	}

	public function addAdditionalRequisite(RequisiteValue $value)
	{
		$this->additionalRequisites[] = $value;
	}

	public function getAdditionalRequisites()
	{
		return $this->additionalRequisites;
	}
}
