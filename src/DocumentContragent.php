<?php

namespace irpsv\commerceml;

class DocumentContragent extends Contragent
{
	protected $role;
	protected $score;
	protected $store;

	public function setRole(string $value)
	{
		$this->role = $value;
	}

	public function getRole(): ?string
	{
		return $this->role;
	}

	public function setScore(Score $value)
	{
		$this->score = $value;
	}

	public function getScore(): ?Score
	{
		return $this->score;
	}

	public function setStore(Store $value)
	{
		$this->store = $value;
	}

	public function getStore(): ?Store
	{
		return $this->store;
	}

	public static function createFrom(Contragent $value)
	{
		$ret = new self();
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
