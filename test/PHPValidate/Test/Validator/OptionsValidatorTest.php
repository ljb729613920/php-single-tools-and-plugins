<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 13:37
 */

namespace PHPValidate\Test\Validator;


use JFernando\PHPValidate\OptionsValidator;
use PHPUnit\Framework\TestCase;

class OptionsValidatorTest extends TestCase
{

    /**
     * @var OptionsValidator
     */
    private $validator;

    public function setUp()
    {
        $this->validator = new OptionsValidator();
        parent::setUp();
    }

    public function testDeveRetornarFalso(){
        $this->assertFalse($this->validator->isValid('teste', [123, 'tt']));
    }

    public function testDeveRetornarVerdade(){
        $this->assertTrue($this->validator->isValid('teste', [123, 'teste']));
    }
}