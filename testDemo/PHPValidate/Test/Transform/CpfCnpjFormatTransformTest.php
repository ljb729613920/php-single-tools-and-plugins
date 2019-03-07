<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 18/01/17
 * Time: 20:19
 */

namespace PhpValidate\Test\Transform;


use JFernando\PHPValidate\Transform\CpfCnpjFormatTransform;
use PHPUnit\Framework\TestCase;

class CpfCnpjFormatTransformTest extends TestCase
{

    public function testFormatarCpfCnpj()
    {
        $transform = new CpfCnpjFormatTransform();

        $this->assertEquals('123.456.789-10', $transform->transform('12345678910'));
        $this->assertEquals('12.456.789/0001-10', $transform->transform('12456789000110'));
        $this->assertEquals('12.456.789/0001-10', $transform->transform('12456789/0001-10'));
    }

}