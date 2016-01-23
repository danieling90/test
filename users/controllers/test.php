<?php

class test { 

	private $cosa = "daniel";

	public function test(){
		$this->cosa = "hola";
	}

	public  function testMethod(){
		echo "holaaaaaa ".$this->cosa;
	}
}

$obj = new test();

$obj->testMethod();



?>