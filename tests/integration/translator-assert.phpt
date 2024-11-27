--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Factory;
use Respect\Validation\Validator;

Factory::setDefaultInstance(
    (new Factory())
        ->withTranslator(static function (string $message): string {
            return [
                'All of the required rules must pass for {{name}}'
                    => 'Todas as regras requeridas devem passar para {{name}}',
                'The length of'
                    => 'O comprimento de',
                '{{name}} must be of type string'
                    => '{{name}} deve ser do tipo string',
                '{{name}} must be between {{minValue}} and {{maxValue}}'
                    => '{{name}} deve possuir de {{minValue}} a {{maxValue}} caracteres',
                '{{name}} must be a valid telephone number for country {{countryName|trans}}'
                    => '{{name}} deve ser um número de telefone válido para o país {{countryName|trans}}',
                'United States' => 'Estados Unidos',
            ][$message] ?? $message;
        })
);

exceptionFullMessage(static fn() => Validator::stringType()->lengthBetween(2, 15)->phone('US')->assert(0));
?>
--EXPECT--
- Todas as regras requeridas devem passar para 0
  - 0 deve ser do tipo string
  - O comprimento de 0 deve possuir de 2 a 15 caracteres
  - 0 deve ser um número de telefone válido para o país Estados Unidos
