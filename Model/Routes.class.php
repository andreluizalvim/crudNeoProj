<?php 
Class Rotas{
	public static $pag;
	private static $pasta_controller = 'controller';
    private static $pasta_view = 'view';
    
	static function get_SiteHome(){
		return Config::SITE_URL.'/'.Config::SITE_PASTA;
    }
    
    static function get_SiteRAIZ(){
		return $_SERVER['DOCUMENT_ROOT'].'/'.Config::SITE_PASTA;
    }
}