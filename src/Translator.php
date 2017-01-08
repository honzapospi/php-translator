<?php

namespace JP\Translator;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * Translator
 * @author Jan Pospisil
 */

class Translator extends \Nette\Object {

	public static $prefix = 'tr_';
	private $dictionary;
	private $model;
	private $lang;

	public function __construct(IDictionaryModel $dictionaryModel) {
		$this->model = $dictionaryModel;
	}

	public function setLang($lang){
		$this->lang = $lang;
	}

	function translate($message, $count = NULL) {
		if($this->dictionary === NULL)
			$this->dictionary = $this->model->getDictionary();
		if(substr($message, 0, strlen(self::$prefix)) != self::$prefix)
			return $message;
		if(!$this->lang)
			throw new \InvalidArgumentException('Language not specified');
		if(array_key_exists($message, $this->dictionary)){
			return $this->dictionary[$message][$this->lang] ? $this->dictionary[$message][$this->lang] : $message;
		}
		$this->model->addTerm($message, $this->lang);
		return $message;
	}

	public function translateTo($message, $lang){
		if($this->dictionary === NULL)
			$this->dictionary = $this->model->getDictionary();
		if(substr($message, 0, strlen(self::$prefix)) != self::$prefix)
			return $message;
		if(array_key_exists($message, $this->dictionary))
			return $this->dictionary[$message][$lang] ? $this->dictionary[$message][$lang] : $message;
		$this->model->addTerm($message, $lang);
		return $message;
	}
}
