<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 17/11/16
 * Time: 16:53
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\CpfCnpjValidator;
use JFernando\PHPValidate\CpfValidator;
use PHPUnit\Framework\TestCase;

class CpfCnpjValidatorTest extends TestCase
{

    public function testDeveRetornarFalso(){
        $this->assertFalse((new CpfCnpjValidator())->isValid('957.227.492-22'));
        $this->assertFalse((new CpfCnpjValidator())->isValid('95722749222'));
        $this->assertFalse((new CpfCnpjValidator())->isValid(''));
        $this->assertFalse((new CpfCnpjValidator())->isValid('teste'));
        $this->assertFalse((new CpfCnpjValidator())->isValid(null));
        $this->assertFalse((new CpfCnpjValidator())->isValid('32418274000181'));
        $this->assertFalse((new CpfCnpjValidator())->isValid('32.418.274/0001-81'));
        $this->assertFalse((new CpfCnpjValidator())->isValid('false'));
        $this->assertFalse((new CpfCnpjValidator())->isValid(''));
        $this->assertFalse((new CpfCnpjValidator())->isValid(null));
        $this->assertFalse((new CpfCnpjValidator())->isValid(true));
        $this->assertFalse((new CpfCnpjValidator())->isValid(false));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue((new CpfCnpjValidator())->isValid('84723617485'));
        $this->assertTrue((new CpfCnpjValidator())->isValid('847.236.174-85'));
        $this->assertTrue((new CpfCnpjValidator())->isValid('32418274000191'));
        $this->assertTrue((new CpfCnpjValidator())->isValid('32.418.274/0001-91'));
    }

}