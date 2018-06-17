--FILE--
<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\MockObject\Generator;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\ExecutableException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$mockGenerator = new Generator();

$dummyFunction = $mockGenerator->getMock(
    'SplFileInfo',
    ['isExecutable'],
    ['somefile.txt']
);
$dummyFunction->expects(TestCase::any())
        ->method('isExecutable')
        ->will(TestCase::returnValue(true));

try {
    v::executable()->check('bar');
} catch (ExecutableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::executable())->check($dummyFunction);
} catch (ExecutableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::executable()->assert('bar');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::executable())->assert($dummyFunction);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"bar" must be an executable file
"somefile.txt" must not be an executable file
- "bar" must be an executable file
- "somefile.txt" must not be an executable file
