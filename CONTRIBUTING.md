# Contributing

Contributions to Respect\Validation are always welcome. You make our lives
easier by sending us your contributions through [pull requests][].

Pull requests for bug fixes must be based on the oldest stable version's branch
whereas pull requests for new features must be based on the `master` branch.

Due to time constraints, we are not always able to respond as quickly as we
would like. Please do not take delays personal and feel free to remind us here,
on IRC, or on Gitter if you feel that we forgot to respond.

Please see the [project documentation][] before proceeding. You should also know
about [PHP-FIG][]'s standards and basic unit testing, but we're sure you can
learn that just by looking at other validators. Pick the simple ones like `ArrayType`
to begin.

Before writing anything, feature or bug fix:

- Check if there is already an issue related to it (opened or closed) and if
  someone is already working on that;
  - If there is not, [open an issue][] and notify everybody that you're going
    to work on that;
  - If there is, create a comment to notify everybody that you're going to
    work on that.
- Make sure that what you need is not done yet

## Adding a new validator

A common validator on Respect\Validation is composed of three classes:

- `library/Rules/YourValidatorName.php`: the validator itself
- `tests/unit/Rules/YourValidatorNameTest.php`: tests for the validator

The classes are pretty straightforward. In the sample below, we're going to
create a validator that validates if a string is equal to "Hello World".

- Classes should be `final` unless they are used in a different scope;
- Properties should be `private` unless they are used in a different scope;
- Classes should use strict typing;
- Some docblocks are required.

### Creating the validator

The validator itself needs to implement the `Validator` interface but, it is
convenient to just extend the `Simple` class for simple validators.
Doing that, you'll only need to declare one method: `isValid($input)`.
This method must return `true` or `false`.

If your validator class is `HelloWorld`, it will be available as `v::helloWorld()`
and will natively have support for chaining and everything else.

```php
<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

#[Template(
    '{{subject}} must be a Hello World',
    '{{subject}} must not be a Hello World',
)]
final class HelloWorld extends Simple
{
    protected function isValid(mixed $input): bool
    {
        return $input === 'Hello World';
    }
}
```

### Creating unit tests

Finally, we need to test if everything is running smooth. We have `RuleTestCase`
that allows us to make easier to test validators, but you fell free to use the
`PHPUnit\Framework\TestCase` if you want or you need it's necessary.

The `RuleTestCase` extends PHPUnit's `PHPUnit\Framework\TestCase` class, so you
are able to use any methods of it. By extending `RuleTestCase` you should
implement two methods that should return a [data provider][] with the validator as
first item of the arrays:

- `providerForValidInput`: Will test when `validate()` should return `true`
- `providerForInvalidInput`: Will test when `validate()` should return `false`

```php
<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(HelloWorld::class)]
final class HelloWorldTest extends RuleTestCase
{
    /** @return array<array{HelloWorld, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield [new HelloWorld(), 'Hello World'];
    }

    /** @return array<array{HelloWorld, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new HelloWorld();

        yield [$validator, 'Not a hello'];
        yield [$validator, 'Hello darkness, my old friend'];
        yield [$validator, 'Hello is it me you\'re looking for?'];
    }
}
```

If the constructor of your validator accepts arguments you may create specific tests
for it other than what is covered by `RuleTestCase`.

### Helping us a little bit more

Your validator will be accepted only with these 3 files (validator and unit test),
but if you really want to help us, you can follow the example of [ArrayType][] by:

- Adding your new validator on the `Validator`'s class docblock;
- Writing a documentation for your new validator;
- Creating integration tests with PHPT.

As we already said, none of them are required but you will help us a lot.

## Documentation

Our docs at https://respect-validation.readthedocs.io are generated from our
Markdown files. Add your brand new validator and it should be soon available.

## Running Tests

After run `composer install` on the library's root directory you must run PHPUnit.

### Linux

You can test the project using the commands:

```sh
$ vendor/bin/phpunit
```

or

```sh
$ composer phpunit
```

### Windows

You can test the project using the commands:

```sh
> vendor\bin\phpunit
```

or

```sh
> composer phpunit
```

No test should fail.

You can tweak the PHPUnit's settings by copying `phpunit.xml.dist` to `phpunit.xml`
and changing it according to your needs.

[ArrayType]: https://github.com/Respect/Validation/commit/f08a1fa
[data provider]: https://phpunit.de/manual/current/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.data-providers "PHPUnit Data Providers"
[open an issue]: http://github.com/Respect/Validation/issues
[PHP-FIG]: http://www.php-fig.org "PHP Framework Interop Group"
[project documentation]: https://respect-validation.readthedocs.io/ "Respect\\Validation documentation"
[pull requests]: http://help.github.com/pull-requests "GitHub pull requests"
