<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/10/16
 * Time: 21:33
 */

namespace PHPValidate\Test\Model;

use JFernando\PHPValidate\Annotation\CNPJ;
use JFernando\PHPValidate\Annotation\CPF;
use JFernando\PHPValidate\Annotation\Max;
use JFernando\PHPValidate\Annotation\Min;
use JFernando\PHPValidate\Annotation\NotEmpty;
use JFernando\PHPValidate\Annotation\NotNull;
use JFernando\PHPValidate\Annotation\Regex;
use JFernando\PHPValidate\Annotation\Validate;

class Pessoa
{
    /**
     * @var string
     * @Min(3)
     * @Max(80)
     * @NotEmpty()
     * @NotNull()
     */
    protected $nome;

    /**
     * @var string
     * @Regex("/\A\(\d{2}\) \d{4}-\d{4}\z/")
     */
    protected $fone;

    /**
     * @var string
     * @CNPJ()
     */
    protected $cnpj;

    /**
     * @var string
     * @CPF()
     */
    protected $cpf;

    /**
     * @var Cidade
     * @Validate(isClass=true)
     */
    protected $cidade;

    /**
     * Pessoa constructor.
     * @param string $nome
     * @param string $fone
     * @param string $cnpj
     * @param string $cpf
     * @param Cidade $cidade
     */
    public function __construct($nome, $fone, $cnpj, $cpf, Cidade $cidade)
    {
        $this->nome = $nome;
        $this->fone = $fone;
        $this->cnpj = $cnpj;
        $this->cpf = $cpf;
        $this->cidade = $cidade;
    }


    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Pessoa
     */
    public function setNome(string $nome): Pessoa
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getFone(): string
    {
        return $this->fone;
    }

    /**
     * @param string $fone
     * @return Pessoa
     */
    public function setFone(string $fone): Pessoa
    {
        $this->fone = $fone;
        return $this;
    }

    /**
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * @param string $cnpj
     * @return Pessoa
     */
    public function setCnpj(string $cnpj): Pessoa
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return Pessoa
     */
    public function setCpf(string $cpf): Pessoa
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return Cidade
     */
    public function getCidade(): Cidade
    {
        return $this->cidade;
    }

    /**
     * @param Cidade $cidade
     * @return Pessoa
     */
    public function setCidade(Cidade $cidade): Pessoa
    {
        $this->cidade = $cidade;
        return $this;
    }

}