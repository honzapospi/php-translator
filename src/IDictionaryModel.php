<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Translator;

/**
 * IDictionaryModel
 * @author Jan Pospisil
 */

interface IDictionaryModel  {

	/**
	 * Get dictionary list
	 * @return array
	 */
	public function getDictionary();

	/**
	 * Add new term to dictionary
	 * @param $term
	 * @return mixed
	 */
	public function addTerm($term);
	
}
