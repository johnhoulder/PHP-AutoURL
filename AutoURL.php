<?php
	class AutoURL{
		//If you want, you can disable this. It is simply to report how many sites are using this library to give me an idea on other stuff
		static protected $statisticCollection = true;
		
		var $replacements = array();
		function __construct($replacements){
			if(gettype($replacements) == "Array"){
				$this->replacements = $replacements;
				foreach($this->replacements as $string => $replacement){
					if(gettype($replacement) == "Array"){
						if(!isset($replacement['limit']) || !isset($replacement['url'])){
							throw new Exception("AutoURL array is not structured correctly",E_WARNING);
							return false;
						}
					}else{
						throw new Exception("AutoURL array is not structured correctly",E_WARNING);
						return false;
					}
				}
			}else{
				throw new Exception("Parameter 1 expected array, got ".gettype($replacements),E_WARNING);
				return false;
			}
		}
		function buffer($output){
			chdir(dirname($_SERVER['SCRIPT_FILENAME'])); //Fixes issues with some servers
			foreach($this->replacements as $string => $aurlarr){
				if($aurlarr['limit'] > 0){
					str_replace($string,"<a href='{$aurlarr['url']}'>$string</a>",$output,$aurlarr['limit']);
				}else{
					str_replace($string,"<a href='{$aurlarr['url']}'>$string</a>");
				}
			}
		}
		function sendStatistics(){
			if(self::$statisticCollection == true){
				if(file_exists("/tmp/php-autourl-library.stats")){
					$data = file_get_contents("/tmp/php-autourl-library.stats");
				}
				if(isset($data)){
					if($data == "0"){
						$result = file_get_contents("http://toxic-productions.com/backend/usage.php?product=autourl&server={$_SERVER['SERVER_NAME']}");
					}
				}
				file_put_contents("/tmp/php-autourl-library.stats","1");
			}
		}
	}
?>
