<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 17/11/16
 * Time: 16:53
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\CpfValidator;
use PHPUnit\Framework\TestCase;

class CpfValidatorTest extends TestCase
{

    public function testDeveRetornarFalso(){
        $this->assertFalse((new CpfValidator())->isValid('957.227.492-22'));
        $this->assertFalse((new CpfValidator())->isValid('95722749222'));
        $this->assertFalse((new CpfValidator())->isValid(''));
        $this->assertFalse((new CpfValidator())->isValid('teste'));
        $this->assertFalse((new CpfValidator())->isValid(null));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue((new CpfValidator())->isValid('84723617485'));
        $this->assertTrue((new CpfValidator())->isValid('847.236.174-85'));
    }

}