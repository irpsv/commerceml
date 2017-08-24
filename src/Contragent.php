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

	public function getId(): string
	{
		return $this->id;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment(): ?string
	{
		return $this->comment;
	}

	public function setAddress(Address $value)
	{
		$this->address = $value;
	}

	public function getAddress(): ?Address
	{
		return $this->address;
	}

	public function addContact(Contact $value)
	{
		$this->contacts[] = $value;
	}

	public function getContacts(): array
	{
		return $this->contacts;
	}

	public function addRepresentatives(Representative $value)
	{
		$this->representatives[] = $value;
	}

	public function getRepresentatives(): array
	{
		return $this->representatives;
	}

	public function setRequisitiesIndividual(RequisitiesIndividual $value)
	{
		$this->requisitiesIndividual = $value;
		$this->requisitiesOrganisation = null;
	}

	public function getRequisitiesIndividual(): ?RequisitiesIndividual
	{
		return $this->requisitiesIndividual;
	}

	public function setRequisitiesOrganisation(RequisitiesOrganisation $value)
	{
		$this->requisitiesIndividual = null;
		$this->requisitiesOrganisation = $value;
	}

	public function getRequisitiesOrganisation(): ?RequisitiesOrganisation
	{
		return $this->requisitiesOrganisation;
	}
}
