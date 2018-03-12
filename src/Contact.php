<?php

namespace irpsv\commerceml;

class Contact extends Model
{
	const TYPE_PHONE_INTERNAL = "Телефон внутренний";
	const TYPE_PHONE_WORK = "Телефон рабочий";
	const TYPE_PHONE_MOBILE = "Телефон мобильный";
	const TYPE_PHONE_HOME = "Телефон домашний";
	const TYPE_PAIGER = "Пейджер";
	const TYPE_FAX = "Факс";
	const TYPE_MAIL = "Почта";
	const TYPE_ICQ = "ICQ";
	const TYPE_SITE = "ВебСайт";
	const TYPE_COORDINATES = "Координаты на карте";
	const TYPE_OTHER = "Прочее";

	protected $type;
	protected $value;
	protected $comment;

	public function setType(string $value)
	{
		$this->type = $value;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setValue(string $value)
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setComment(string $value)
	{
		$this->comment = $value;
	}

	public function getComment()
	{
		return $this->comment;
	}
}
