--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessages(static fn () => v::key('firstname', v::notBlank()->setName('First Name'))->assert([]));
?>
--EXPECTF--
[
    'firstname' => 'First Name must be present',
]
