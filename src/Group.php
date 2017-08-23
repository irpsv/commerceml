<?php

class Group
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

	public function setDesc(string $value)
	{
		$this->desc = $value;
	}

	public function getDesc(): ?string
	{
		return $this->desc;
	}

	public function addProperty(Property $value)
	{
		$this->properties[] = $value;
	}

	public function getProperties(): array
	{
		return $this->properties;
	}

	public function addGroup(Group $value)
	{
		$this->groups[] = $value;
	}

	public function getGroups(): array
	{
		return $this->groups;
	}
}
