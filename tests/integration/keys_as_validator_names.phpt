--FILE--
<?php

declare(strict_types=1);

date_default_timezone_set('UTC');

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionFullMessage(static function (): void {
    Validator::create()
        ->key('username', Validator::length(Validator::between(2, 32)))
        ->key('birthdate', Validator::dateTime())
        ->setName('User Subscription Form')
        ->assert(['username' => '0', 'birthdate' => 'Whatever']);
});
?>
--EXPECT--
- All of the required rules must pass for User Subscription Form
  - The length of username must be between 2 and 32
  - birthdate must be a valid date/time
