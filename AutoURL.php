<?php
	class AutoURL{
		//If you want, you can disable this. It is simply to report how many sites are using this library to give me an idea on other stuff
		static protected $statisticCollection = true;
		
		var $replacements = array();
		function __construct($replacements){
			if(gettype($replacements) == "array"){
				$this->replacements = $replacements;
				foreach($this->replacements as $string => $replacement){
					if(gettype($replacement) == "array"){
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
				throw new Exception("Parameter 1 expected Array, got ".gettype($replacements),E_WARNING);
				return false;
			}
			$this->sendStatistics();
		}
		function buffer($output){
			chdir(dirname($_SERVER['SCRIPT_FILENAME'])); //Fixes issues with some servers
			print_r("Replacements");
			foreach($this->replacements as $string => $aurlarr){
				if($aurlarr['limit'] > 0){
					$output = str_replace($string,"<a href='{$aurlarr['url']}'>$string</a>",$output,$aurlarr['limit']);
				}else{
					$output = str_replace($string,"<a href='{$aurlarr['url']}'>$string</a>",$output);
				}
			}
			return $output;
		}
		private function sendStatistics(){
			if(self::$statisticCollection == true){
				if(file_exists("/tmp/php-autourl-library.stats")){
					$data = file_get_contents("/tmp/php-autourl-library.stats");
				}
				if(isset($data)){
					if($data == "0"){
						$result = file_get_contents("http://toxic-productions.com/backend/usage.php?product=autourl&server={$_SERVER['SERVER_NAME']}&ip={$_SERVER['SERVER_ADDR']}");
					}
				}else{
					$result = file_get_contents("http://toxic-productions.com/backend/usage.php?product=autourl&server={$_SERVER['SERVER_NAME']}&ip={$_SERVER['SERVER_ADDR']}");
				}
				file_put_contents("/tmp/php-autourl-library.stats","1");
			}
		}
	}
?>
