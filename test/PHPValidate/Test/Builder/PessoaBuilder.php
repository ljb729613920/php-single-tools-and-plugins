<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/10/16
 * Time: 21:50
 */

namespace PHPValidate\Test\Builder;

use PHPValidate\Test\Model\Cidade;
use PHPValidate\Test\Model\Pessoa;

class PessoaBuilder
{

    private $nome;
    private $fone;
    private $cnpj;
    private $cpf;
    private $cidade;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function withFone(string $fone){
        $this->fone = $fone;
        return $this;
    }

    public function withCnpj(string $cnpj){
        $this->cnpj = $cnpj;
        return $this;
    }

    public function withCpf(string $cpf){
        $this->cpf = $cpf;
        return $this;
    }

    public function livesIn(Cidade $cidade){
        $this->cidade = $cidade;
        return $this;
    }

    public function build(){
        return new Pessoa($this->nome, $this->fone, $this->cnpj, $this->cpf, $this->cidade);
    }

}