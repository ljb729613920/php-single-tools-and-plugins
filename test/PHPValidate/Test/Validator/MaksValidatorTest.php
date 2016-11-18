<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 10:48
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\MaskValidator;
use PHPUnit\Framework\TestCase;

class MaksValidatorTest extends TestCase
{

    public function testDeveRetornarFalso(){
        $this->assertFalse((new MaskValidator())->isValid('123', 'aaa'));
        $this->assertFalse((new MaskValidator())->isValid('abc', '999'));
        $this->assertFalse((new MaskValidator())->isValid('abc123', 'aaaaaa'));
        $this->assertFalse((new MaskValidator())->isValid('abc123', '999999'));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue((new MaskValidator())->isValid('123', '999'));
        $this->assertTrue((new MaskValidator())->isValid('abc', 'aaa'));
        $this->assertTrue((new MaskValidator())->isValid('abc', 'a{3}'));
        $this->assertTrue((new MaskValidator())->isValid('abcdefghijklmopqr', 'aaaaaaaaaaaaaaaaa'));
        $this->assertTrue((new MaskValidator())->isValid('a1b2c3', 'a9a9a9'));
        $this->assertTrue((new MaskValidator())->isValid('a1b2c3-123', 'a9a9a9-999'));
    }

}