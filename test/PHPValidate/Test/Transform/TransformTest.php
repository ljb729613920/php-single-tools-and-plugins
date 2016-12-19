<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/12/16
 * Time: 02:53
 */

namespace PhpValidate\Test\Transform;


use JFernando\PHPValidate\Transform\Transformation;
use PHPUnit\Framework\TestCase;
use PHPValidate\Test\Builder\PessoaBuilder;
use PHPValidate\Test\Model\Cidade;

class TransformTest extends TestCase
{

    public function testTransform(){
        $builder = new PessoaBuilder('Teste');
        $pessoa = $builder->withFone('(99) 1234-1234')
            ->livesIn(new Cidade("Ji-Parana", 'RO'))
            ->withCpf('001.002.003-00')
            ->withCnpj('')
            ->build();

        (new Transformation())->transform($pessoa);

        $this->assertEquals('00100200300', $pessoa->getCpf());
        $this->assertEquals('9912341234', $pessoa->getFone());
    }


}