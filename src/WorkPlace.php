<?php

namespace irpsv\commerceml;

class WorkPlace extends Model
{
	protected $organisation;
	protected $post; // должность

	public function setOrganisation(RequisitiesOrganisation $value)
	{
		$this->organisation = $value;
	}

	public function getOrganisation()
	{
		return $this->organisation;
	}

	public function setPost(string $value)
	{
		$this->post = $value;
	}

	public function getPost()
	{
		return $this->post;
	}
}
