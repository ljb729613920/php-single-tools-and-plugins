# PHP Validations
A set of tools for validations with PHP.

## Introduction
This library offers tools for validations of many kinds of problem:

* `ValidatorVerifier` A set of tools for object validations based in annotations, having inspiration in **Java Beans Validations**
* `Transformation` A object transformation based in annotations 
* `MapValidate` A simple set of tools for validate associative array
* `Schema` A set of tools for validate associative array, schema based, inspirated in [hapijs/joi](https://github.com/hapijs/joi)

## `ValidatorVerifier`
```php
    
```

## `Transformation`
```php
    
```

## `MapValidate`
```php
    
```

## `Schema`
```php
    $schema = Schema::schema([
        'name'    => Schema::string()->min(3)->max(80),
        'address' => Schema::schema([
            'street' => Schema::string()->min(3)->max(50)
            'number' => Schema::numeric(['code' => 'invalid_number', 'message' => 'Invalid number']),
            'other' => Schema::string()->required(false) // Optional field
        ]),
        'projects'  => Schema::array()->schema([
            'name' => Schema::string()
        ])
    ]);
    
    $errors = $schema->getErrors($data);
    $errors->isValid(); // true | false
    $errors->getErrors(); //
```
This library is expansive for use custom validations

