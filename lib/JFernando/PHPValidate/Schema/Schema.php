<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 1:51 PM
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\NumericValidator;

class Schema extends PipeValidation
{

    public function __construct(array $validations)
    {
        parent::__construct($validations);
    }

    public static function params(array $data) {
        return new Params($data);
    }

    public static function schema(array $schema)
    {
        return new SchemaValidation($schema);
    }

    public static function string($params = []) {
        $params['code'] = $params['code'] ?? 'string';
        return new StringPipeValidator($params);
    }

    public static function integer($params = [])
    {
        $params['code'] = $params['code'] ?? 'integer';
        return new IntegerPipeValidation($params);
    }

    public static function collection($params = [])
    {
        $params['code'] = $params['code'] ?? 'collection';
        return new ArrayPipeValidation($params);
    }

    public static function pipeline($validator, $params = [])
    {
        $params['code'] = $params['code'] ?? 'pipeline';
        return (new PipeValidation([]))->pipe($validator, $params);
    }

    public static function numeric($params = [])
    {
        $params['code'] = $params['code'] ?? 'numeric';
        return new PipeValidation([new ValidationAdapter($params, new NumericValidator())]);
    }

}