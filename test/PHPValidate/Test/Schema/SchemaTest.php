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
                    'nome' => '1'
                ]
            ]
        ];

        $data = Schema::params($data)->only(['nome','cpfCnpj', 'endereco', 'representantes']);
        var_dump($data);

        $schema = Schema::schema([
//            'nome' => Schema::string(['code' => 'wow'])->min(10, ['code' => 'wow2'])->required(['code' => 'wow3']),
//            'cpfCnpj' => Schema::string()->pipe(new CpfCnpjValidator(), ['code' => 'bemlokoessecpf']),
//            'endereco' => Schema::schema([
//                'logradouro' => Schema::string()->min(10),
//                'numero' => Schema::integer()->min(10)->max(50)
//            ]),
            'representantes' => Schema::collection()->min(1)->schema([
                'nome' => Schema::string()->required()
            ], ['code' => 'invalid_schema'])
        ]);

        var_dump($schema->validate(null, $data));

    }

}