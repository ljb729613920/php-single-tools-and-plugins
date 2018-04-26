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
            ->map(function(Validation $validation, $key) use ($value) {
                $result = $validation->validate($key, $value[$key] ?? null);
                if($validation->name && is_array($result) && count($result) > 0) {
                    $result['name'] = $validation->name;
                };
                return $result;
            })
            ->filter(function($arr) {
                return (bool) $arr;
            })
            ->map(function ($data, $key) use ($field) {
                $path = $data['path'] ?? null;
                $name = $data['name'] ?? null;

                if($field) {
                    if($path) {
                        $path = "{$field}.{$key}.{$path}";
                    } else {
                        $path = "{$field}.{$key}";
                    }
                } else {
                    $path = $key;
                }

                if($name) {
                    $path = "{$path}.{$name}";
                }

                $data['path'] = $path;

                return $data;
            })
            ->toArray();
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