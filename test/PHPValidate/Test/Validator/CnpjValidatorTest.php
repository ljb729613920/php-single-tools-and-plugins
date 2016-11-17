<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 17/11/16
 * Time: 16:58
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\CnpjValidator;
use PHPUnit\Framework\TestCase;

class CnpjValidatorTest extends TestCase
{

    public function testDeveRetornarFalso(){
        $this->assertFalse((new CnpjValidator())->isValid('32418274000181'));
        $this->assertFalse((new CnpjValidator())->isValid('32.418.274/0001-81'));
        $this->assertFalse((new CnpjValidator())->isValid('false'));
        $this->assertFalse((new CnpjValidator())->isValid(''));
        $this->assertFalse((new CnpjValidator())->isValid(null));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue((new CnpjValidator())->isValid('32418274000191'));
        $this->assertTrue((new CnpjValidator())->isValid('32.418.274/0001-91'));
    }

}