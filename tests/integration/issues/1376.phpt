--FILE--
<?php

require 'vendor/autoload.php';

exceptionAll('https://github.com/Respect/Validation/issues/1376', static function (): void {
    v::property('title', v::lengthBetween(2, 3)->stringType())
            ->property('description', v::stringType())
            ->property('author', v::intType()->lengthBetween(1, 2))
            ->property('user', v::intVal()->lengthBetween(1, 2))
            ->assert((object) ['author' => 'foo']);
});

?>
--EXPECT--
https://github.com/Respect/Validation/issues/1376
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
title must be present
- All of the required rules must pass for `stdClass { +$author="foo" }`
  - title must be present
  - description must be present
  - All of the required rules must pass for author
    - author must be an integer
    - The length of author must be between 1 and 2
  - user must be present
[
    '__root__' => 'All of the required rules must pass for `stdClass { +$author="foo" }`',
    'title' => 'title must be present',
    'description' => 'description must be present',
    'author' => [
        '__root__' => 'All of the required rules must pass for author',
        'intType' => 'author must be an integer',
        'lengthBetween' => 'The length of author must be between 1 and 2',
    ],
    'user' => 'user must be present',
]
