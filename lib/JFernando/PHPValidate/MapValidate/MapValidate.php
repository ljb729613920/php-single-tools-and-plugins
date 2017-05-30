<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 30/05/17
 * Time: 13:21
 */

namespace JFernando\PHPValidate\MapValidate;


use JFernando\PHPValidate\DefaultValidator;
use JFernando\PHPValidate\Exception\ValidatorError;
use JFernando\PHPValidate\Validator;

class MapValidate
{

    protected $config;

    public function __construct( array $config )
    {
        $this->config = $config;
    }

    public function validate( array $params )
    {
        $erros = [];
        foreach ( $this->config as $key => $item ) {
            $required   = $item[ 'required' ] ?? false;
            $validate   = $item[ 'validator' ] ?? new DefaultValidator();
            $code       = $item[ 'code' ] ?? "field_${$key}_invalid";
            $message    = $item[ 'message' ] ?? "Field ${$key} is not valid";
            $parameters = $item[ 'params' ]  ?? [];
            $valueParam = $item[ 'value' ] ?? '';
            $value      = $params[ $key ] ?? null;

            if ( $value === null && $required ) {
                $erros[] = new ValidatorError( $code, $message, $parameters );

                continue;
            }

            if ( $validate instanceof Validator ) {
                if ( !$validate->isValid( $value, $valueParam) ){
                    $erros[] = new ValidatorError($code, $message, $parameters);
                }

                continue;
            }

            if (is_callable($validate)){
                if ($validate($value, $valueParam, $parameters)){
                    $erros[] = new ValidatorError($code, $message, $parameters);
                }
                continue;
            }
        }

        return $erros;
    }

}