<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/10/16
 * Time: 21:57
 */

namespace PHPValidate\Test;

use JFernando\PHPValidate\ValidatorVerifier;
use PHPValidate\Test\Builder\PessoaBuilder;
use PHPValidate\Test\Model\Cidade;
use PHPValidate\Test\Model\Pessoa;
use PHPUnit\Framework\TestCase;

class ValidateVerifierTest extends TestCase
{
    /**
     * @var Pessoa $pessoa
     */
    private $pessoa;

    /**
     * @var ValidatorVerifier $verifier
     */
    private $verifier;

    public function setUp()
    {
        $this->pessoa = (new PessoaBuilder('Jorge'))
            ->withCnpj('37.561.502/0001-00')
            ->withCpf('957.274.932-34')
            ->withFone('(69) 3421-3287')
            ->livesIn(new Cidade('Jipa', 'AC'))
            ->build();

        $this->verifier = new ValidatorVerifier(true);
    }

    private function defaultTest(){
        $errors = $this->verifier->validate($this->pessoa);

        $this->assertTrue(count($errors) === 0 );
    }

    public function testPessoaWithValidCPF(){
        $this->defaultTest();
    }

    public function testPessoaWithEstadoInvalido(){
        $this->pessoa->setCidade(new Cidade('Ji-Parana', 'PR'));
        $errors = $this->verifier->validate($this->pessoa);

        $this->assertTrue(count($errors) === 1 );
    }

    public function testPessoaWithInvalidCPF(){
        $this->pessoa->setCpf('123.456.789-00');
        $errors = $this->verifier->validate($this->pessoa);

        $this->assertTrue(count($errors) === 1 );
    }

    public function testPessoaWithValidCNPJ(){
        $this->defaultTest();
    }

    public function testPessoaWithInvalidCNPJ(){
        $this->pessoa->setCnpj('12.456.789/0001-00');
        $errors = $this->verifier->validate($this->pessoa);

        $this->assertTrue(count($errors) === 1 );
    }

    public function testPessoaWithValidNome(){
        $this->defaultTest();
    }

    public function testPessoaWithInvalidNome(){
        $this->pessoa->setNome('');
        $errors = $this->verifier->validate($this->pessoa);

        $this->assertTrue(count($errors) === 2 );
    }

    public function testPessoaWithValidFone(){
        $this->defaultTest();
    }

    public function testPessoaWithInvalidFone(){
        $this->pessoa->setFone('(69) 9341-32989');
        $errors = $this->verifier->validate($this->pessoa);

        $this->assertTrue(count($errors) === 1 );
    }

}