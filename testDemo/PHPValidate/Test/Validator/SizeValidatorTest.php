<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 08:37
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\SizeValidator;
use PHPUnit\Framework\TestCase;

class SizeValidatorTest extends TestCase
{

    public function testDeveRetornarFalso(){
        $this->assertFalse((new SizeValidator())->isValid("JORGE", 2));
        $this->assertFalse((new SizeValidator())->isValid(3, 2));
        $this->assertFalse((new SizeValidator())->isValid(null, 2));
        $this->assertFalse((new SizeValidator())->isValid(true, 2));
        $this->assertFalse((new SizeValidator())->isValid(false, 2));
        $this->assertFalse((new SizeValidator())->isValid("", 2));
        $this->assertFalse((new SizeValidator())->isValid(1, 2));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue((new SizeValidator())->isValid('jorge', 5));
        $this->assertTrue((new SizeValidator())->isValid('', 0));
        $this->assertTrue((new SizeValidator())->isValid('1', 1));
        $this->assertTrue((new SizeValidator())->isValid(2, 2));
        $this->assertTrue((new SizeValidator())->isValid('000', 3));
        $this->assertTrue((new SizeValidator())->isValid([1, 2, 3], 3));
    }

}