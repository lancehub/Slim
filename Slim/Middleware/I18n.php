<?php

class Slim_Middleware_I18n extends Slim_Middleware{
	
	protected $settings;

	public function __construct($settings = array()){
		$this->settings = array_merge(array('path'=>'./langs','default_lang'=>'en_US','domain'=>'default'),$settings);
	}

	public function call(){
		
		$lang = $this->settings['default'];
		if($this->app->request()->get('lang')) $lang = $this->app->request()->get('lang');

		putenv('LANG='.$lang);
		setlocale(LC_ALL,$lang.'.UTF-8');

		$domain = $this->settings['domain'];

		bindtextdomain($domain,$this->settings['path']);
		textdomain($domain);

		$this->next->call();
	}
}
