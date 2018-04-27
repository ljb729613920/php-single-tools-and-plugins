<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/24/18
 * Time: 8:29 PM
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\CnpjValidator;
use JFernando\PHPValidate\CpfCnpjValidator;
use JFernando\PHPValidate\CpfValidator;
use JFernando\PHPValidate\MaxValidator;
use JFernando\PHPValidate\MinValidator;
use JFernando\PHPValidate\StringValidator;
use JFernando\PHPValidate\Utils\ArrayUtil;
use JFernando\PHPValidate\Validator;

class ExpressionValidation extends PipeValidation
{
    protected $params;

    private static $expressions;


    public function __construct(string $expression, array $params = [])
    {
        parent::__construct([]);

        $this->params = $params;

        if (!self::$expressions) {
           self::initializeDefaultExpressions();
        }

        $pipes = explode('|', $expression);

        foreach ($pipes as $pipe) {
            $this->toValidator($pipe);
        }
    }

    private function toValidator($pipe)
    {
        $params = explode(':', $pipe);

        if (count($params) < 1) {
            throw new \InvalidArgumentException('Invalid expression');
        }

        $util = new ArrayUtil($params);
        $validatorName = $util->first();
        $param = [];

        if (count($params) > 1) {
            $param = $util->drop(1)->toVector();
            if(count($param) === 1) {
                $param = $param[0];
            }
        }

        $validator = self::$expressions[$validatorName] ?? null;

        if (!$validator) {
            throw new \InvalidArgumentException("Invalid pipe '${validatorName}'");
        }

        return $this->pipe($validator, ['name' => $validatorName, 'param' => $param]);
    }

    private static function initializeDefaultExpressions()
    {
        self::newExpression('min', new MinValidator());
        self::newExpression('max', new MaxValidator());
        self::newExpression('string', new StringValidator());
        self::newExpression('cpfCnpj', new CpfCnpjValidator());
        self::newExpression('cpf', new CpfValidator());
        self::newExpression('cnpj', new CnpjValidator());
    }

    public static function newExpression(string $name, $validator) {
        if (!self::$expressions) {
            self::$expressions = [];
        }

        if(array_key_exists($name, self::$expressions)) {
            throw new \InvalidArgumentException("Expression '${name}' already registered");
        }

        if ($validator instanceof Validator || $validator instanceof Validation || is_callable($validator)) {
            self::$expressions[$name] = $validator;
            return;
        }

        throw new \InvalidArgumentException('Invalid expression');
    }
}