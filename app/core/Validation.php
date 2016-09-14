<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class Validation
{
	private $passed = false;
	private $errors = [];
	private $db = null;
	private $allowed_rules = ['required','min','max','matches','unique'];

	private function check($source, array $items = [])
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$values = $source[$item];
				if($rule === 'required' && empty($values)) {
					$this->addError("{$item} should be required");
				} elseif (!empty($values)) {
					switch ($rule) {
						case 'min':
							if(strlen($values) < $rule_value){
								$this->addError("{$item} must be a minimum of {$rule_value}");
							}
							break;
						case 'max':
							if(strlen($values) > $rule_value){
								$this->addError("{$item} must be a maximum of {$rule_value}");
							}
							break;
						case 'matches':
							if($values != $source[$rule_value]){
								$this->addError("{$item} must match {$rule_value}");
							}
							break;
						case 'unique':
							$check = Capsule::table($rule_value)->where($item,'=',$values)->get();
							if(count($check)){
								$this->addError("{$item} already exists");
							}
							break;
					}
				}
			}	
		}
		if(empty($this->errors)) {
			$this->passed = true;
		}
		return $this;
	}

	public function validate($source, array $items = [])
	{
		foreach ($items as $field => $rules) {
			$vertical_bar = explode('|', $rules);
			$rules = [];
			foreach ($vertical_bar as $rule) {
				$colon = explode(':', $rule);
				if(count($colon) == 1){
					if($this->isInRule($colon[0])){
						array_push($colon, true);
						list($key, $value) = $colon;
					}
				} else {
					if($this->isInRule($colon[0])){
						list($key, $value) = $colon;
						if((int)$value) $value = (int)$value;
					}
				}
				$rules[$key] = $value; 
			}
			$this->rules[$field] = $rules;
		}
		$this->check($source, $this->rules);
	}

	private function addError($error)
	{
		$this->errors[] = $error;
	}

	public function errors()
	{
		return $this->errors;
	}

	public function passed()
	{
		return $this->passed;
	}

	private function isInRule($rule)
	{
		if(!in_array($rule, $this->allowed_rules)){
			throw new \Exception("{$rule} not allowed", 1);
		}
		return true;
	}

}