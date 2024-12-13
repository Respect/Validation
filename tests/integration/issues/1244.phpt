--FILE--
<?php

require 'vendor/autoload.php';

exceptionAll(
    'https://github.com/Respect/Validation/issues/1244',
    static fn () => v::key('firstname', v::notBlank()->setName('First Name'))->assert([])
);
?>
--EXPECT--
https://github.com/Respect/Validation/issues/1244
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
First Name must be present
- First Name must be present
[
    'firstname' => 'First Name must be present',
]
