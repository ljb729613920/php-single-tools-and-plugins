<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 04/10/16
 * Time: 23:32
 */

namespace JFernando\PHPValidate;

class CpfValidator implements Validator
{

    public function isValid($content, $param = '') : bool
    {
        if (gettype($content) !== 'string') {
            return false;
        }

        $regexOne = '/\A\d{3}.\d{3}.\d{3}-\d{2}\z/';
        $regexTwo = '/\A\d{11}\z/';

        if (preg_match($regexOne, $content)) {
            return $this->validateSpecial($content);
        } elseif (preg_match($regexTwo, $content)) {
            return $this->validate($content);
        }

        return false;
    }

    private function validateSpecial($content)
    {
        $content = str_replace(['.', '-'], '', $content);

        return $this->validate($content);
    }

    private function validate($content)
    {
        $inicio = substr($content, 0, 9);
        $fim = substr($content, 9, strlen($content));

        $first = $this->validateFirstDigit($inicio, (int) $fim[0]);

        if (!$first) {
            return false;
        }

        return $this->validateSecondDigit($inicio.$fim[0], (int) $fim[1]) && $first;
    }

    private function validateSecondDigit($inicio, $verificador)
    {
        return $this->validateFirstDigit($inicio, $verificador, 11);
    }

    private function validateFirstDigit($inicio, $verificador, $aux = 10)
    {
        $soma = 0;

        for ($i=0; $i < strlen($inicio); $i++) {
            $digito = (int) $inicio[$i];
            $soma += $digito * $aux;
            $aux--;
        }

        $resto = (int) $soma % 11;

        if ($resto < 2) {
            return $verificador === 0;
        }

        return $verificador === (11 - $resto);
    }
}
