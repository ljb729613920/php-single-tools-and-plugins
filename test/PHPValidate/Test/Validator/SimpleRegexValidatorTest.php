<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:09
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\RegexValidator;
use JFernando\PHPValidate\SimpleRegexValidator;
use PHPUnit\Framework\TestCase;

class SimpleRegexValidatorTest extends TestCase
{

    public function testDeveRetornarFalso(){
        $this->assertFalse((new SimpleRegexValidator())->isValid('01', ""));
        $this->assertFalse((new SimpleRegexValidator())->isValid('Nome', "nome"));
        $this->assertFalse((new SimpleRegexValidator())->isValid(null,  "\d+"));
        $this->assertFalse((new SimpleRegexValidator())->isValid(true,  ""));
        $this->assertFalse((new SimpleRegexValidator())->isValid(false,  "\d{2}"));
        $this->assertFalse((new SimpleRegexValidator())->isValid('1263',  "\d{1, 3}"));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue((new SimpleRegexValidator())->isValid('01', "\d{2}"));
        $this->assertTrue((new SimpleRegexValidator())->isValid('1', "\d"));
        $this->assertTrue((new SimpleRegexValidator())->isValid('Nome', "\w{4}"));
        $this->assertTrue((new SimpleRegexValidator())->isValid('1263',  "\d{4}"));
    }

}