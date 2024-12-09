--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Test\Stubs\WithAttributes;

run([
    'Default' => [v::attributes(), new WithAttributes('', 'john.doe@gmail.com', '2024-06-23')],
    'Inverted' => [v::attributes(), new WithAttributes('John Doe', 'john.doe@gmail.com', '2024-06-23', '+1234567890')],
    'Not an object' => [v::attributes(), []],
    'Nullable' => [v::attributes(), new WithAttributes('John Doe', 'john.doe@gmail.com', '2024-06-23', 'not a phone number')],
    'Multiple attributes, all failed' => [v::attributes(), new WithAttributes('', 'not an email', 'not a date', 'not a phone number')],
    'Multiple attributes, one failed' => [v::attributes(), new WithAttributes('John Doe', 'john.doe@gmail.com', '22 years ago')],
]);
?>
--EXPECTF--
Default
⎺⎺⎺⎺⎺⎺⎺
name must not be empty
- name must not be empty
[
    'name' => 'name must not be empty',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
phone must be a valid telephone number or must be null
- phone must be a valid telephone number or must be null
[
    'phone' => 'phone must be a valid telephone number or must be null',
]

Not an object
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
`[]` must be an object
- `[]` must be an object
[
    'attributes' => '`[]` must be an object',
]

Nullable
⎺⎺⎺⎺⎺⎺⎺⎺
phone must be a valid telephone number or must be null
- phone must be a valid telephone number or must be null
[
    'phone' => 'phone must be a valid telephone number or must be null',
]

Multiple attributes, all failed
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
name must not be empty
- All of the required rules must pass for `Respect\Validation\Test\Stubs\WithAttributes { +$name="" +$email="not an email" +$birthdate="not a date" +$phone ... }`
  - name must not be empty
  - email must be a valid email address
  - All of the required rules must pass for birthdate
    - birthdate must be a valid date in the format "%d-%d-%d"
    - For comparison with now, birthdate must be a valid datetime
  - phone must be a valid telephone number or must be null
[
    '__root__' => 'All of the required rules must pass for `Respect\\Validation\\Test\\Stubs\\WithAttributes { +$name="" +$email="not an email" +$birthdate="not a date" +$phone ... }`',
    'name' => 'name must not be empty',
    'email' => 'email must be a valid email address',
    'birthdate' => [
        '__root__' => 'All of the required rules must pass for birthdate',
        'date' => 'birthdate must be a valid date in the format "%d-%d-%d"',
        'dateTimeDiffLessThanOrEqual' => 'For comparison with now, birthdate must be a valid datetime',
    ],
    'phone' => 'phone must be a valid telephone number or must be null',
]

Multiple attributes, one failed
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
birthdate must be a valid date in the format "%d-%d-%d"
- birthdate must be a valid date in the format "%d-%d-%d"
[
    'birthdate' => 'birthdate must be a valid date in the format "%d-%d-%d"',
]
