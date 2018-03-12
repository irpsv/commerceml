<?php

namespace irpsv\commerceml;

class OrganisationHead extends Model
{
	use HumanInfoTrait;

	protected $post;
	protected $contacts = [];

	public function setPost(string $value)
	{
		$this->post = $value;
	}

	public function getPost()
	{
		return $this->post;
	}

	public function addContact(Contact $value)
	{
		$this->contacts[] = $value;
	}

	public function getContacts()
	{
		return $this->contacts;
	}
}
