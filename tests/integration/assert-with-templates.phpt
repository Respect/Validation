--FILE--
<?php

use Respect\Validation\Exceptions\ValidationException;

require 'vendor/autoload.php';

exceptionAll(
    'Template as a string in the chain',
    static fn() => v::alwaysInvalid()->setTemplate('My string template in the chain')->assert(1)
);

exceptionAll(
    'Template as an array in the chain',
    static fn() => v::alwaysInvalid()->setTemplates(['alwaysInvalid' => 'My array template in the chain'])->assert(1)
);

exceptionAll(
    'Runtime template as string',
    static fn() => v::alwaysInvalid()->assert(1, 'My runtime template as string')
);

exceptionAll(
    'Runtime template as an array',
    static fn() => v::alwaysInvalid()->assert(1, ['alwaysInvalid' => 'My runtime template an array'])
);

heading('Runtime template as an exception');
try {
    v::alwaysInvalid()->assert(1, new Exception('My runtime template as an exception'));
} catch (Throwable $exception) {
    echo $exception->getMessage();
    echo PHP_EOL . PHP_EOL;
}

heading('Runtime template as a callable');
try {
    v::alwaysInvalid()
        ->assert(1, static fn(ValidationException $exception) => new Exception('My runtime template as an exception: ' . $exception->getMessage()));
} catch (Throwable $exception) {
    echo $exception->getMessage();
    echo PHP_EOL . PHP_EOL;
}
?>
--EXPECT--
Template as a string in the chain
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
My string template in the chain
- My string template in the chain
[
    'alwaysInvalid' => 'My string template in the chain',
]

Template as an array in the chain
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
My array template in the chain
- My array template in the chain
[
    'alwaysInvalid' => 'My array template in the chain',
]

Runtime template as string
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
My runtime template as string
- My runtime template as string
[
    'alwaysInvalid' => 'My runtime template as string',
]

Runtime template as an array
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
My runtime template an array
- My runtime template an array
[
    'alwaysInvalid' => 'My runtime template an array',
]

Runtime template as an exception
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
My runtime template as an exception

Runtime template as a callable
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
My runtime template as an exception: 1 must be valid
