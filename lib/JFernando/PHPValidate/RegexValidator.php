<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 20:52
 */

namespace JFernando\PHPValidate;

class RegexValidator implements Validator
{

    public function isValid($content, $param) : bool
    {

        if (is_array($content)) {
            $valid = true;

            foreach ($content as $item) {
                $valid = $valid && $this->isValid($item, $param);
            }

            return $valid;
        }

        $result = preg_match($param, (string) $content);

        if (is_array($result)) {
            return count($result) === 1;
        }

        return $result;
    }
}
