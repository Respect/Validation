--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Test\Stubs\WithAttributes;

run([
    'Default' => [v::attributes(), new WithAttributes('', 'john.doe@gmail.com', '1912-06-23')],
    'Inverted' => [v::attributes(), new WithAttributes('John Doe', 'john.doe@gmail.com', '1912-06-23', '+1234567890')],
    'Failed nullable property' => [v::attributes(), new WithAttributes('John Doe', 'john.doe@gmail.com', '1912-06-23', 'not a phone number')],
]);
?>
--EXPECTF--
Default
⎺⎺⎺⎺⎺⎺⎺
name must not be empty
- The properties of `Respect\Validation\Test\Stubs\WithAttributes { +$name="" +$email="john.doe@gmail.com" +$birthdate="%d-%d-%d" + ... }` must be valid
  - name must not be empty
  - The number of years between now and %d-%d-%d must be less than or equal to 25
[
    '__root__' => 'The properties of `Respect\\Validation\\Test\\Stubs\\WithAttributes { +$name="" +$email="john.doe@gmail.com" +$birthdate="%d-%d-%d" + ... }` must be valid',
    'name' => 'name must not be empty',
    'birthdate.2' => 'The number of years between now and %d-%d-%d must be less than or equal to 25',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and %d-%d-%d must be less than or equal to 25
- The properties of `Respect\Validation\Test\Stubs\WithAttributes { +$name="John Doe" +$email="john.doe@gmail.com" +$birthdate="1912- ... }` must be valid
  - The number of years between now and %d-%d-%d must be less than or equal to 25
  - phone must be a valid telephone number or must be null
[
    '__root__' => 'The properties of `Respect\\Validation\\Test\\Stubs\\WithAttributes { +$name="John Doe" +$email="john.doe@gmail.com" +$birthdate="1912- ... }` must be valid',
    'birthdate.2' => 'The number of years between now and %d-%d-%d must be less than or equal to 25',
    'phone' => 'phone must be a valid telephone number or must be null',
]

Failed nullable property
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and %d-%d-%d must be less than or equal to 25
- The properties of `Respect\Validation\Test\Stubs\WithAttributes { +$name="John Doe" +$email="john.doe@gmail.com" +$birthdate="1912- ... }` must be valid
  - The number of years between now and %d-%d-%d must be less than or equal to 25
  - phone must be a valid telephone number or must be null
[
    '__root__' => 'The properties of `Respect\\Validation\\Test\\Stubs\\WithAttributes { +$name="John Doe" +$email="john.doe@gmail.com" +$birthdate="1912- ... }` must be valid',
    'birthdate.2' => 'The number of years between now and %d-%d-%d must be less than or equal to 25',
    'phone' => 'phone must be a valid telephone number or must be null',
]
