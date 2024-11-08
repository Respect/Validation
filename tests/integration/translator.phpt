--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Message\Translator\ArrayTranslator;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorDefaults;

ValidatorDefaults::setTranslator(new ArrayTranslator([
    'All of the required rules must pass for {{name}}' => 'Todas as regras requeridas devem passar para {{name}}',
    'The length of' => 'O comprimento de',
    '{{name}} must be of type string' => '{{name}} deve ser do tipo string',
    '{{name}} must be between {{minValue}} and {{maxValue}}' => '{{name}} deve possuir de {{minValue}} a {{maxValue}} caracteres',
    '{{name}} must be a valid telephone number for country {{countryName|trans}}'
        => '{{name}} deve ser um número de telefone válido para o país {{countryName|trans}}',
    'United States' => 'Estados Unidos',
    'years' => 'anos',
    'The number of {{type|trans}} between now and' => 'O número de {{type|trans}} entre agora e',
    '{{name}} must be equal to {{compareTo}}' => '{{name}} deve ser igual a {{compareTo}}',
]));

exceptionFullMessage(static fn() => Validator::stringType()->lengthBetween(2, 15)->phone('US')->assert(0));
exceptionMessage(static fn() => v::dateTimeDiff('years', v::equals(2))->assert('1972-02-09'));
?>
--EXPECT--
- Todas as regras requeridas devem passar para 0
  - 0 must be a string
  - O comprimento de 0 deve possuir de 2 a 15 caracteres
  - 0 deve ser um número de telefone válido para o país Estados Unidos
O número de anos entre agora e 1972-02-09 deve ser igual a 2
