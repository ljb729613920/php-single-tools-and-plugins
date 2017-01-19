<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 18/01/17
 * Time: 20:07
 */

namespace JFernando\PHPValidate\Transform;


class CpfCnpjFormatTransform implements Transformer
{

    public function transform( $value )
    {
        $value = preg_replace('/\D/', '', $value);

        if(strlen($value) > 11) return $this->formatCnpj($value);

        return $this->formatCpf($value);
    }

    private function formatCnpj($cnpj)
    {
        $inicio = substr($cnpj, 0, 2);
        $meio1 = substr($cnpj, 2, 3);
        $meio2 = substr($cnpj, 5, 3);
        $empresa = substr($cnpj, 8, 4);
        $fim = substr($cnpj, strlen($cnpj) - 2, 2);

        return "${inicio}.${meio1}.${meio2}/${empresa}-${fim}";
    }

    private function formatCpf($cpf)
    {
        $inicio = substr($cpf, 0, 3);
        $meio1 = substr($cpf, 3, 3);
        $meio2 = substr($cpf, 6, 3);
        $fim = substr($cpf, strlen($cpf) - 2, 2);

        return "${inicio}.${meio1}.${meio2}-${fim}";
    }
}