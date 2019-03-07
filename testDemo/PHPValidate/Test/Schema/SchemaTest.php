<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 1:39 PM
 */

namespace PHPValidate\Test\Schema;


use JFernando\PHPValidate\CpfCnpjValidator;
use JFernando\PHPValidate\Schema\Schema;
use PHPUnit\Framework\TestCase;

class SchemaTest extends TestCase
{

    public function testSchemaValidation() {
        $data = [
            'nome' => 'Jorge Fernando',
            'cpfCnpj' => '95727493234',
            'endereco' => [
                'logradouro' => 'Rua saõ paulp kahdk akdjas',
                'numero' => 32
            ],
            'representantes' => [
                [
                    'nsome' => 'Jose'
                ]
            ]
        ];

        $data = Schema::params($data)->only(['nome','cpfCnpj', 'endereco', 'representantes']);
        var_dump($data);

        $schema = Schema::schema([
            'nome' => Schema::string(['code' => 'wow'])->min(10, ['code' => 'wow2'])->required(false),
            'cpfCnpj' => Schema::string()->pipe(new CpfCnpjValidator(), ['code' => 'bemlokoessecpf'])->required(false),
            'endereco' => Schema::schema([
                'logradouro' => Schema::string()->min(10),
                'numero' => Schema::integer()->min(10)->max(50)
            ])->required(true),
            'representantes' => Schema::collection()->min(1)->schema([
                'nome' => Schema::string()->required()
            ], ['code' => 'invalid_schema'])
        ]);

        var_dump($schema->errors($data));

    }

    public function testSchemaValidationWithExpression()
    {
        $schema = Schema::schema([
            'name' => Schema::expression('string|min:10|max:40')
        ]);

        var_dump($schema->errors(['name' => 'Jorge Fernando']));
    }

}