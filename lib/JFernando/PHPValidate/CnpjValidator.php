<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 04/10/16
 * Time: 23:28
 */

namespace JFernando\PHPValidate;

class CnpjValidator implements Validator
{

    public function isValid($content, $param = '') : bool
    {
        if (gettype($content) !== 'string') {
            return false;
        }

        $regexOne = '/\A\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}\z/';
        $regexTwo = '/\A\d{14}\z/';

        if (preg_match($regexOne, $content)) {
            $content = str_replace(['.', '/', '-'], '', $content);
            return $this->validate($content);
        } elseif (preg_match($regexTwo, $content)) {
            return $this->validate($content);
        }

        return false;
    }

    private function validate($content)
    {
        if($this->isEveryEquals($content)) {
            return false;
        };

        $inicio = substr($content, 0, 12);
        $fim = substr($content, 12, 14);

        $sumFirst = $this->calculate($inicio);
        $sumSecond = $this->calculate($inicio.$fim[0], 6);

        $first = $this->isDigitValid($sumFirst, (int) $fim[0]);
        $second = $this->isDigitValid($sumSecond, (int) $fim[1]);

        return ($first && $second);
    }

    private function isDigitValid($sum, $digit)
    {
        if (($sum % 11) < 2) {
            return  ( (int) $digit === 0 );
        }

        return ( (int) $digit === ( 11 - ($sum % 11)) );
    }

    private function calculate($str, $aux = 5)
    {
        $count = 0;

        for ($i = 0; $i < strlen($str); $i++) {
            $digit = (int) $str[$i];
            $count += $digit * $aux;
            $aux--;

            if ($aux < 2) {
                $aux = 9;
            }
        }

        return $count;
    }

    private function isEveryEquals( $content )
    {
        $quantity = 0;
        $anterior = null;
        for($i = 0; $i < strlen($content); $i++) {
            if(!$anterior) {
                $anterior = $content[$i];
            }

            if (($content[$i]) === $anterior) {
                $quantity++;
            }
        }

        return ($quantity === strlen($content));
    }
}
