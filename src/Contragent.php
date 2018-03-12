<?php

namespace irpsv\commerceml;

class Contragent extends Model
{
	protected $id;
	protected $name;
	protected $comment;
	protected $address;
	protected $contacts = []; // контакты
	protected $representatives = [];
	protected $requisitiesIndividual;
	protected $requisitiesOrganisation;

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

	public function addRepresentative(Representative $value)
	{
		$this->representatives[] = $value;
	}

	public function getRepresentatives()
	{
		return $this->representatives;
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

	public static function createFrom(Contragent $value)
	{
		$ret = new static();
		if ($value->getId()) {
			$ret->setId($value->getId());
		}
		if ($value->getName()) {
			$ret->setName($value->getName());
		}
		if ($value->getComment()) {
			$ret->setComment($value->getComment());
		}
		if ($value->getAddress()) {
			$ret->setAddress($value->getAddress());
		}
		if ($value->getRequisitiesIndividual()) {
			$ret->setRequisitiesIndividual($value->getRequisitiesIndividual());
		}
		if ($value->getRequisitiesOrganisation()) {
			$ret->setRequisitiesOrganisation($value->getRequisitiesOrganisation());
		}
		foreach ($value->getContacts() as $item) {
			$ret->addContact($item);
		}
		foreach ($value->getRepresentatives() as $item) {
			$ret->addRepresentative($item);
		}
		return $ret;
	}
}
