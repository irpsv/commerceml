<?php

namespace irpsv\commerceml;

/**
 * Представитель
 */
class Representative extends Model
{
	protected $id;
	protected $name;
	protected $requisitiesIndividual;
	protected $requisitiesOrganisation;
	protected $comment;
	protected $address;
	protected $contacts = [];
	protected $relation; // Описывает отношение (связь) представителя и контрагента. Примеры значений: "Контактное лицо", "Филиал", "Главный офис" и т.п.

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setRequisitiesIndividual(RequisitiesIndividual $value)
	{
		$this->requisitiesIndividual = $value;
		$this->requisitiesOrganisation = null;
	}

	public function getRequisitiesIndividual()
	{
		return $this->requisitiesIndividual;
	}

	public function setRequisitiesOrganisation(RequisitiesOrganisation $value)
	{
		$this->requisitiesIndividual = null;
		$this->requisitiesOrganisation = $value;
	}

	public function getRequisitiesOrganisation()
	{
		return $this->requisitiesOrganisation;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function setAddress(Address $value)
	{
		$this->address = $value;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function addContact(Contact $value)
	{
		$this->contacts[] = $value;
	}

	public function getContacts()
	{
		return $this->contacts;
	}

	public function setRelation(string $value)
	{
		$this->relation = $value;
	}

	public function getRelation()
	{
		return $this->relation;
	}
}
