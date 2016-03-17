--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

function translatorCallback($message)
{
    $messages = [
        'All of the required rules must pass for {{name}}' => 'Todas as regras requeridas devem passar para {{name}}',
        '{{name}} must be a string' => '{{name}} deve ser uma string',
        '{{name}} must have a length between {{minValue}} and {{maxValue}}' => '{{name}} deve possuir de {{minValue}} a {{maxValue}} caracteres',
    ];

    return $messages[$message];
}

try {
    Validator::stringType()->length(2, 15)->assert(0);
} catch (NestedValidationException $exception) {
    $exception->setParam('translator', 'translatorCallback');

    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- Todas as regras requeridas devem passar para 0
  - 0 deve ser uma string
  - 0 deve possuir de 2 a 15 caracteres
