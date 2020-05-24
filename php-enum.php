<?php
abstract class EnumType 
{
	private $value;

	public function __construct(int $value = null)
	{
		$reflectionClass = new ReflectionClass($this);
		$constants = $reflectionClass->getConstants();
		$instanceClassName = get_called_class();
			
		if($value === null)
		{
			if(!isset($constants["__default"]))
				throw new UnexpectedValueException("Default value not defined and no initialisation value given in $instanceClassName");
				
			$this->value = $constants["__default"];
		}
		else
		{
			$allowedValues = array_values($constants);
			
			if(!in_array($value, $allowedValues))
				throw new UnexpectedValueException("Value not in const list in $instanceClassName");
				
			$this->value = $value;
		}
	}
	
	public function __toString()
	{
		return (string)$this->value;
	}
	
	public function __toInt()
	{
		return $this->value;
	}

	public function getConstList(bool $includeDefault = false)
	{
		$reflectionClass = new ReflectionClass($this);
		$constants = $reflectionClass->getConstants();
		
		if($includeDefault)
			return $constants;
			
		unset($constants["__default"]);
		return $constants;
	}
}
