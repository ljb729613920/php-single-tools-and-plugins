<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 1:39 PM
 */

namespace PHPValidate\Test\Schema;


use JFernando\PHPValidate\CpfCnpjValidator;
use PHPUnit\Framework\TestCase;

class SchemaTest extends TestCase
{

    public function testSchemaValidation() {
//        $data = [];
//
//        $data = Schema::params($data)->only(['nome']);
//
//        $schema = Schema::schema([
//            'nome' => Schema::string()->min(10)->required(),
//            'cpfCnpj' => Schema::string()->pipe(new CpfCnpjValidator(), []),
//            'endereco' => Schema::schema([
//                'logradouro' => Schema::string()->min(10),
//                'numero' => Schema::integer()->min(10)->max(50)->pipe(function($value) {}, [])
//            ]),
//            'representantes' => Schema::array()->min(10)->max(20)->schema([
//                'nome' => Schema::string(),
//                'cpfCnpj' => Schema::string()->pipe(new CpfCnpjValidator(), [])
//            ])
//        ]);


    }

}