<?php
class Validate {
	private $_errors = array();
	
	private $_required = array();
	
	private $_valid = true;
	
	public function addRequiredFields($requiredFields) {
		array_push($this->_required, $requiredFields);
	}
	
	public function checkRequired($fields) {
		foreach ($fields as $key => $value) {
			if (in_array($key, $this->_required)) {
				if (empty($value)) {
					$this->_errors[$key] = "{$key} should not be empty";
					$this->_valid = false;
				}
			}
		}
	}
	
	public function validateLength($name, $value, $min, $max) {
		$field = trim($value);
		if (strlen($value) < intval($min)) {
			$this->_errors[$name] = "The Length Of {$name} should not be less than {$min} characters";
			$this->_valid = false;
		}
		
		if (strlen($field) > intval($max)) {
			$this->_errors[$name] = "The Length Of {$name} should not be greater than {$max} characters";
			$this->_valid = false;
		}
	}
	
	public function isChecked($name, $value) {
		if (!isset($_POST[$value])) {
			$this->_errors[$name] = "Please select {$name}";
			$this->_valid = false;
		}
	}
	
	public function isEqual($name1, $value1, $name2, $value2) {
		$value1 = trim($value1);
		$value2 = trim($value2);
		
		if ($value1 != $value2) {
			$this->_errors[$value1] = "{$name1} and {$name2} does not match.";
			$this->_valid = false;
		}
	}
	
	public function fileSelected($name, $value) {
		if ($_FILES[$value]['tmp_name'] == '') {
			$this->_errors[$name] = "Please select {$name}.";
			$this->_valid = false;
		};
	}
	
	public function getRequiredFields() {
		return $this->_required;
	}
	
	public function getErrors() {
		return $this->_errors;
	}
	
	public function errorOccured() {
		if (count($this->_errors) > 0) return true;
		else return false;
	}
}
?>