--FILE--
<?php

require 'vendor/autoload.php';

exceptionAll(
    'https://github.com/Respect/Validation/issues/1333',
    static fn() => v::noWhitespace()->email()->setName('User Email')->assert('not email')
);
?>
--EXPECT--
https://github.com/Respect/Validation/issues/1333
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
User Email must not contain whitespaces
- All of the required rules must pass for User Email
  - User Email must not contain whitespaces
  - User Email must be a valid email address
[
    '__root__' => 'All of the required rules must pass for User Email',
    'noWhitespace' => 'User Email must not contain whitespaces',
    'email' => 'User Email must be a valid email address',
]
