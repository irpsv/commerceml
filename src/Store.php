<?php

namespace irpsv\commerceml;

class Store extends Model
{
	protected $id;
	protected $name;
	protected $comment;
	protected $address;
	protected $contacts = []; // контактная информация

	public function setId(string $value)
	{
		$this->id = $value;
	}

	public function getId(): ?string
	{
		return $this->id;
	}

	public function setName(string $value)
	{
		$this->name = $value;
	}

	public function getName(): ?string
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
}
