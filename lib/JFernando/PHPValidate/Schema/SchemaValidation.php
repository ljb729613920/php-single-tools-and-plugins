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

        return $util
            ->map(function(Validation $validation, $key) use ($value) {
                return $validation->validate($key, $value[$key] ?? null);
            })
            ->filter(function($arr) {
                return (bool) $arr;
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