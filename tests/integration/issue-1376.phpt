--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionFullMessage(static function (): void {
    v::property('title', v::length(2, 3)->stringType())
            ->property('description', v::stringType())
            ->property('author', v::intType()->length(1, 2))
            ->property('user', v::intVal()->length(1, 2))
            ->assert((object) ['author' => 'foo']);
});

?>
--EXPECT--
- All of the required rules must pass for `stdClass { +$author="foo" }`
  - Property title must be present
  - Property description must be present
  - All of the required rules must pass for author
    - author must be of type integer
    - author must have a length between 1 and 2
  - Property user must be present
