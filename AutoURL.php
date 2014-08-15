<?php
	class AutoURL{
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
	}
?>
