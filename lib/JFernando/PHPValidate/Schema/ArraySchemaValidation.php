<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 23/04/18
 * Time: 17:22
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\Utils\ArrayUtil;

class ArraySchemaValidation extends PipeValidation
{
    protected $schema;

    public function __construct( array $schema )
    {
        parent::__construct( [] );
        $this->schema = $schema;
    }

    public function validate( $field, $value )
    {
        $values = $value ?? [];

        $result = [];
        foreach ( $values as $item ) {
            $schema = new SchemaValidation($this->schema);
            $result[] = $schema->validate(null, $item);;
        }

        return (new ArrayUtil($result))
            ->filter(function ($arr) {
                return is_array($arr) && count($arr) > 0;
            })
            ->toVector();
    }
}