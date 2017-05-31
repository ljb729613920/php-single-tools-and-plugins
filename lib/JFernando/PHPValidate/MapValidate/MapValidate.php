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
use JFernando\PHPValidate\Utils\Messages;
use JFernando\PHPValidate\Utils\Reflection;
use JFernando\PHPValidate\Validator;

class MapValidate
{

    protected $config;
    protected $messages;

    const REQUIRED  = 'required';
    const VALIDATOR = 'validator';
    const CODE      = 'code';
    const MESSAGE   = 'message';
    const PARAMS    = 'params';
    const VALUE     = 'value';

    public function __construct( array $config, Messages $messages = null )
    {
        $this->config   = $config;
        $this->messages = $messages;
    }

    public function validate( array $params )
    {
        $erros = [];
        foreach ( $this->config as $key => $item ) {
            $required   = $item[ self::REQUIRED ] ?? false;
            $validate   = $item[ self::VALIDATOR ] ?? new DefaultValidator();
            $code       = $item[ self::CODE ] ?? "field_${key}_invalid";
            $message    = $item[ self::MESSAGE ] ?? "Field ${key} is not valid";
            $parameters = $item[ self::PARAMS ]  ?? [];
            $valueParam = $item[ self::VALUE ] ?? '';
            $value      = $params[ $key ] ?? null;

            if ( $this->messages ) {
                $message = $this->messages->get( $code, $message );
            }

            if ( $value === null && $required ) {
                $erros[] = new ValidatorError( $code, $message, $parameters );

                continue;
            }

            if ( $validate instanceof Validator ) {
                if ( !$validate->isValid( $value, $valueParam ) ) {
                    $erros[] = new ValidatorError( $code, $message, $parameters );
                }

                continue;
            }

            if (class_exists($validate)){
                $class = new Reflection($validate);
                if($class->isSubclassOf(Validator::class)){
                    /** @var Validator $instance */
                    $instance = $class->newInstanceWithoutConstructor();
                    if(!$instance->isValid($value, $valueParam)){
                        $erros[] = new ValidatorError( $code, $message, $parameters );
                    }
                }
            }

            if ( is_callable( $validate ) ) {
                if ( !$validate( $value, $valueParam, $parameters ) ) {
                    $erros[] = new ValidatorError( $code, $message, $parameters );
                }
                continue;
            }
        }

        return $erros;
    }

}