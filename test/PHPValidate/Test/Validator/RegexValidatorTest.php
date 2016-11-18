<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:09
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\RegexValidator;
use PHPUnit\Framework\TestCase;

class RegexValidatorTest extends TestCase
{

    public function testDeveRetornarFalso(){
        $this->assertFalse((new RegexValidator())->isValid('01', "/\A\z/"));
        $this->assertFalse((new RegexValidator())->isValid('Nome', "/\Anome\z/"));
        $this->assertFalse((new RegexValidator())->isValid(null,  "/\A\d+\z/"));
        $this->assertFalse((new RegexValidator())->isValid(true,  "/\A\z/"));
        $this->assertFalse((new RegexValidator())->isValid(false,  "/\A\d\z/"));
        $this->assertFalse((new RegexValidator())->isValid('1263',  "/\A\d{1, 3}\z/"));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue((new RegexValidator())->isValid('01', "/\A\d{2}\z/"));
        $this->assertTrue((new RegexValidator())->isValid('Nome', "/\A\w{4}\z/"));
        $this->assertTrue((new RegexValidator())->isValid('1263',  "/\A\d{4}\z/"));
    }

}