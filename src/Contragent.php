<?php

namespace irpsv\commerceml\types;

class Contragent
{
	protected $id;
	protected $name;
	protected $comment;
	protected $address;
	protected $contactInfo;
	protected $representatives = [];
	protected $requisitiesIndividual;
	protected $requisitiesOrganisation;

	public function setId(string $value)
	{
		$this->Id = $value;
	}

	public function getId(): string
	{
		return $this->Id;
	}

	public function setName(string $value)
	{
		$this->Name = $value;
	}

	public function getName(): string
	{
		return $this->Name;
	}

	public function setComment(string $value)
	{
		$this->Comment = $value;
	}

	public function getComment(): ?string
	{
		return $this->Comment;
	}

	public function setAddress(Address $value)
	{
		$this->Address = $value;
	}

	public function getAddress(): ?Address
	{
		return $this->Address;
	}

	public function setContactInfo(ContactInfo $value)
	{
		$this->contactInfo = $value;
	}

	public function getContactInfo(): ?ContactInfo
	{
		return $this->contactInfo;
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
		$this->RequisitiesIndividual = $value;
	}

	public function getRequisitiesIndividual(): ?RequisitiesIndividual
	{
		return $this->RequisitiesIndividual;
	}

	public function setRequisitiesOrganisation(RequisitiesOrganisation $value)
	{
		$this->requisitiesOrganisation = $value;
	}

	public function getRequisitiesOrganisation(): ?RequisitiesOrganisation
	{
		return $this->requisitiesOrganisation;
	}
}
