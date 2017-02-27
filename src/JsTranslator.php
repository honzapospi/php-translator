<?php
namespace JP\Translator;
use Nette\Utils\Html;
use Nette\Utils\Json;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * JsTranslator.php
 * @author Jan Pospisil
 */

class JsTranslator extends \Nette\Object {

	private $model;
	private $lang;
	private $devMode;
	private $link;

	public function __construct(IDictionaryModel $model) {
		$this->model = $model;
	}

	public function setLingAddTranslation($link){
		$this->link = $link;
	}

	public function setDevelopmentMode($bool){
		$this->devMode = $bool;
	}

	public function setLanguage($code){
		$this->lang = $code;
	}

	public function render(){
		if(!$this->lang)
			throw new \InvalidArgumentException('Language is required to render translator.');
		$container = Html::el('script');
		$js = 'var dictionary = '.Json::encode($this->model->getDictionary())."\n";
		$js .= "var LANG = '".$this->lang."';\n";
		$js .= file_get_contents(__DIR__.'/translator.js');
		if($this->devMode){
			$js .= "\nJP.LINK_ADD_TRANSLATION = '".$this->link."';\n";
			$js .= file_get_contents(__DIR__.'/dev.translator.js')."\n";
		}
		$container->setText($js);
		echo $container;
	}
}
