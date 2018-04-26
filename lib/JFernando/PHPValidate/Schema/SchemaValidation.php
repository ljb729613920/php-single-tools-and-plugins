<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 23/04/18
 * Time: 16:01
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\Utils\ArrayUtil;

class SchemaValidation extends Validation
{

    protected $schema;

    public function __construct( array $schema )
    {
        parent::__construct( [] );
        $this->schema = $schema;
    }

    public function validate( $field, $value )
    {
        $util = new ArrayUtil($this->schema);

        if(!$this->required && $value === null) {
            return [];
        }

        return $util
            ->map(function(Validation $validation, $key) use ($value, $field) {
                $result = $validation->validate($key, $value[$key] ?? null);

                if(is_array($result) && count($result) > 0) {
                    if(!ArrayUtil::isAssociativeArray($result)) {
                        $util = new ArrayUtil($result);
                        return $util
                            ->map(function($val) use($field, $key) {
                                return $this->mountPath( $val, $key, $field);
                            })
                            ->toVector();
                    }
                }

                return $result;
            })
            ->filter(function($arr) {
                return (bool) $arr;
            })
            ->toArray();
    }

    public function mountPath( $val, $key, $field )
    {
        $path = $key;
        $name = $val[ 'name' ] ?? null;
        if ( $field ) {
            $path = "{$field}.{$path}";
        }

        if ( $name ) {
            $path = "{$path}.{$name}";
        }

        $val[ 'path' ] = $path;

        return $val;
    }

    public function getErrors(array $data) {
        $errors = $this->validate(null, $data);

        return new ErrorBag($errors);
    }

    public function isValid( $content, $param ): bool
    {
        throw new \BadMethodCallException('not implemented');
    }
}