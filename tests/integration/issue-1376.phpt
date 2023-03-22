--CREDITS--
Alexandre Gomes Gaigalas <alganet@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\RecursiveExceptionIterator;
use Respect\Validation\Validator as v;

$input = (object) [
    'author' => 'foo',
];

$postValidator = v::property('title', v::length(2, 3)->stringType())
            ->property('description', v::stringType())
            ->property('author', v::intType()->length(1, 2))
            ->property('user', v::intVal()->length(1, 2));
try {
    $postValidator->assert($input);
} catch (NestedValidationException $e) {
    echo $e->getFullMessage();
    echo PHP_EOL;
    $explorer = new RecursiveIteratorIterator(
        new RecursiveExceptionIterator($e),
        RecursiveIteratorIterator::SELF_FIRST
    );
    echo PHP_EOL;
    foreach ($explorer as $innerException) {
        var_dump([
            'level' => $explorer->getDepth(),
            'message' => $innerException->getMessage(),
        ]);
    }
}
?>
--EXPECT--
- All of the required rules must pass for `stdClass { +$author="foo" }`
  - Property title must be present
  - Property description must be present
    - All of the required rules must pass for author
      - author must be of type integer
      - author must have a length between 1 and 2
  - Property user must be present

array(2) {
  ["level"]=>
  int(0)
  ["message"]=>
  string(30) "Property title must be present"
}
array(2) {
  ["level"]=>
  int(0)
  ["message"]=>
  string(36) "Property description must be present"
}
array(2) {
  ["level"]=>
  int(0)
  ["message"]=>
  string(29) "Property author must be valid"
}
array(2) {
  ["level"]=>
  int(1)
  ["message"]=>
  string(46) "All of the required rules must pass for author"
}
array(2) {
  ["level"]=>
  int(2)
  ["message"]=>
  string(30) "author must be of type integer"
}
array(2) {
  ["level"]=>
  int(2)
  ["message"]=>
  string(41) "author must have a length between 1 and 2"
}
array(2) {
  ["level"]=>
  int(0)
  ["message"]=>
  string(29) "Property user must be present"
}
