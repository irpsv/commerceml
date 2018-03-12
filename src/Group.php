<?php

namespace irpsv\commerceml;

class Group extends Model
{
	protected $id;
	protected $name;
	protected $desc;
	protected $properties = [];
	protected $groups = [];

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

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc()
	{
		return $this->desc;
	}

	public function addProperty(Property $value)
	{
		$this->properties[] = $value;
	}

	public function getProperties()
	{
		return $this->properties;
	}

	public function addGroup(Group $value)
	{
		$this->groups[] = $value;
	}

	public function getGroups()
	{
		return $this->groups;
	}
}
