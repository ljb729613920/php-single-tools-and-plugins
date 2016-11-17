<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 17/11/16
 * Time: 17:03
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\NumberValidator;
use PHPUnit\Framework\TestCase;

class NumberValidatorTest extends TestCase
{

    public function testDeveRetornarFalso(){
        $this->assertFalse((new NumberValidator())->isValid('nan'));
        $this->assertFalse((new NumberValidator())->isValid('12a'));
        $this->assertFalse((new NumberValidator())->isValid('a12'));
        $this->assertFalse((new NumberValidator())->isValid(''));
        $this->assertFalse((new NumberValidator())->isValid(null));
        $this->assertFalse((new NumberValidator())->isValid(true));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue((new NumberValidator())->isValid(123));
        $this->assertTrue((new NumberValidator())->isValid('123'));
        $this->assertTrue((new NumberValidator())->isValid('123456'));
        $this->assertTrue((new NumberValidator())->isValid('100'));
        $this->assertTrue((new NumberValidator())->isValid('200'));
        $this->assertTrue((new NumberValidator())->isValid('1'));
        $this->assertTrue((new NumberValidator())->isValid(2));
        $this->assertTrue((new NumberValidator())->isValid(0));
        $this->assertTrue((new NumberValidator())->isValid(1));
        $this->assertTrue((new NumberValidator())->isValid('001'));
    }

}