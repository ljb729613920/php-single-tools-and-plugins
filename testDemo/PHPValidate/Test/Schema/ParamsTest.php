<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 2:10 PM
 */

namespace PHPValidate\Test\Schema;


use JFernando\PHPValidate\Schema\Params;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ParamsTest extends TestCase
{

    public function testParams()
    {
        $data = ['name' => 'Jose', 'endereco' => ['teste'=>'teste']];

        $params = new Params($data);

        $data = $params->only(['endereco']);

        $this->assertArrayHasKey('endereco', $data);
        $this->assertArrayNotHasKey('nome', $data);
    }

}