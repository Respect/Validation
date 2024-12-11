--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessages(static fn () => v::key('firstname', v::notBlank()->setName('First Name'))->assert([]));
?>
--EXPECT--
[
    'firstname' => 'First Name must be present',
]
