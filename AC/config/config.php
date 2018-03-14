<?php
date_default_timezone_set('America/Sao_Paulo');

$url = "http://".$_SERVER['SERVER_NAME'].":8010/AC/";


class Config{

	public $config = array(
		'host' => 'localhost' , 
		'dbname' => 'slimpdv' , 
		'user' => 'root' , 
		'pass' => ''
	);


	public function conn(){

		return new PDO(
			'mysql:host='.$this->config['host'].';dbname='.$this->config['dbname'].'',
			$this->config['user'] ,
			$this->config['pass'] ,
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8',
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES, false
			)
		);
	}
}

function geraUrlLimpa($texto){
    /* função que gera uma texto limpo pra virar URL:
       - limpa acentos e transforma em letra normal
       - limpa cedilha e transforma em c normal, o mesmo com o ñ
       - transforma espaços em hifen (-)
       - tira caracteres invalidos
      by Micox - elmicox.blogspot.com - www.ievolutionweb.com
    */
    //desconvertendo do padrão entitie (tipo &aacute; para á)
    $texto = html_entity_decode($texto);
    //tirando os acentos
    $texto = str_replace('[aáàãâä]','a',$texto);
    $texto = str_replace('[eéèêë]','e',$texto);
    $texto = str_replace('[iíìîï]','i',$texto);
    $texto = str_replace('[oóòõôö]','o',$texto);
    $texto = str_replace('[uúùûü]','u',$texto);
    //parte que tira o cedilha e o ñ
    $texto = str_replace('[ç]','c',$texto);
    $texto = str_replace('[ñ]','n',$texto);
    //trocando espaço em branco por underline
    $texto = str_replace(' ','-',$texto);
    //tirando outros caracteres invalidos
    $texto = str_replace('[^a-z0-9\-]','',$texto);
    //trocando duplo espaço (hifen) por 1 hifen só
    $texto = str_replace('--','-',$texto);
    $texto = str_replace('/','',$texto);
    $texto = str_replace('\/','',$texto);
    
    return strtolower($texto);
}