<?php

namespace irpsv\commerceml;

class OrganisationHead
{
	use HumanInfoTrait;

	protected $post;
	protected $contacts = [];

	public function setPost(string $value)
	{
		$this->post = $value;
	}

	public function getPost(): ?string
	{
		return $this->post;
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
