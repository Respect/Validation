--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Factory;
use Respect\Validation\Validator;

Factory::setDefaultInstance(new Factory([], [], function (string $message): string {
    $messages = [
        'All of the required rules must pass for {{name}}' => 'Todas as regras requeridas devem passar para {{name}}',
        '{{name}} must be of type string' => '{{name}} deve ser do tipo string',
        '{{name}} must have a length between {{minValue}} and {{maxValue}}' => '{{name}} deve possuir de {{minValue}} a {{maxValue}} caracteres',
    ];

    return $messages[$message];
}));

try {
    Validator::stringType()->length(2, 15)->assert(0);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- Todas as regras requeridas devem passar para 0
  - 0 deve ser do tipo string
  - 0 deve possuir de 2 a 15 caracteres
