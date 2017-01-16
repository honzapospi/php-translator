<?php
namespace JP\Translator;
use Nette\Caching\Cache;
use Nette\Caching\IStorage;
use Nette\Database\Context;
use Nette\Database\UniqueConstraintViolationException;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * Model
 * @author Jan Pospisil
 */

class DictionaryModel extends \Nette\Object implements IDictionaryModel {

	private $dictionary;
	private $context;
	/**
	 * @var Cache
	 */
	private $cache;

	public function __construct(Context $context) {
		$this->context = $context;
	}

	public function setCacheStorage(IStorage $storage){
		$this->cache = new Cache($storage, '_translator');
	}

	public function getDictionary(){
		if($this->dictionary === null)
			$this->load();
		return $this->dictionary;
	}

	public function invalidateCache(){
		if($this->cache)
			$this->cache->remove('dictionary');
	}

	private function load(){
		$this->dictionary = $this->cache ? $this->cache->load('dictionary') : null;
		if($this->dictionary !== null)
			return;
		$langs = array();
		foreach($this->context->getStructure()->getColumns('dictionary') as $column){
			if(substr($column['name'], 0, 5) == 'lang_'){
				$langs[] = substr($column['name'], 5);
			}
		}
		foreach($this->context->table('dictionary') as $row){
			$data = array();
			foreach($langs as $lang){
				$data[$lang] = $row['lang_'.$lang];
			}
			$this->dictionary[$row->id] = $data;
		}
		$this->dictionary = $this->dictionary === null ? array() : $this->dictionary;
		if($this->cache)
			$this->cache->save('dictionary', $this->dictionary, array(
				Cache::EXPIRE => '1 hour'
			));
	}

	public function addTerm($term){
		try{
			$this->context->query('INSERT INTO dictionary', array(
				'id' => $term
			));
		} catch (UniqueConstraintViolationException $e){

		}
	}

}
