<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/10/16
 * Time: 21:46
 */

namespace PHPValidate\Test\Model;


use JFernando\PHPValidate\Annotation\Max;
use JFernando\PHPValidate\Annotation\Min;
use JFernando\PHPValidate\Annotation\NotEmpty;
use JFernando\PHPValidate\Annotation\NotNull;

class Cidade
{

    /**
     * @var string
     * @NotEmpty()
     * @NotNull()
     */
    protected $nome;

    /**
     * @var string
     * @Min("2")
     * @Max("2")
     */
    protected $uf;

    /**
     * Cidade constructor.
     * @param string $nome
     * @param string $uf
     */
    public function __construct($nome, $uf)
    {
        $this->nome = $nome;
        $this->uf = $uf;
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
     * @return Cidade
     */
    public function setNome(string $nome): Cidade
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getUf(): string
    {
        return $this->uf;
    }

    /**
     * @param string $uf
     * @return Cidade
     */
    public function setUf(string $uf): Cidade
    {
        $this->uf = $uf;
        return $this;
    }

}