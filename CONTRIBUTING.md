<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Contributing

Contributions to Respect\Validation are always welcome. You make our lives
easier by sending us your contributions through [pull requests][].

Due to time constraints, we are not always able to respond as quickly as we
would like. Please do not take delays personally.

Before writing anything, feature or bug fix:

- Check if there is already an issue related to it (opened or closed) and if
  someone is already working on that;
  - If there is not, [open an issue][] and notify everybody that you're going
    to work on that;
  - If there is, create a comment to notify everybody that you're going to
    work on that.
- Make sure that what you need is not done yet.

## Adding a new validator

A common validator on Respect\Validation is composed of three classes:

- `src/Validators/YourValidatorName.php`: the validator itself
- `tests/unit/Validators/YourValidatorNameTest.php`: tests for the validator

The classes are pretty straightforward. In the sample below, we're going to
create a validator that validates if a string is equal to "Hello World".

- Validator classes should be `final` whenever possible.
- Validator classes should `readonly` whenever possible.
- Properties should be `private` and `readonly` whenever possible.

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
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor Your Name <your_email@example.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

#[Template(
    '{{subject}} must be a Hello World',
    '{{subject}} must not be a Hello World',
)]
final readonly class HelloWorld extends Simple
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

The `RuleTestCase` extends PHPUnit's `PHPUnit\Framework\TestCase` class with
conventional [data provider][] methods:

- `providerForValidInput`: Will test when `validate()` should return `true`
- `providerForInvalidInput`: Will test when `validate()` should return `false`

```php
<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor Your Name <your_email@example.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

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

You should include documentation to your new validator. A minimal document
is acceptable. You can use `bin/console lint:docs` to help you ensure that
document follows our conventions. `bin/console lint:docs --fix` will even
fix some common mistakes automatically.

Additionally, consider adding a feature test to `tests/feature`. Those help
us track common use cases and usage patterns.

## Documentation

Our docs at https://respect-validation.readthedocs.io are generated from our
Markdown files. Add your brand new validator and it should be soon available.

You can preview how the docs will look like by running `composer docs-serve`.

## Running Checks

After run `composer install` on the library's root directory you must run
`composer qa`.

This alias will run several checks, including unit tests, static analysis
and more.

Check out the `scripts` section on `composer.json` for more details on which
checks are performed.

## Benchmarks

If you want to improve the project performance or make sure your change doesn't
introduce a performance regression, you can use our standard benchmark suite
at `tests/benchmark`.

Typical workflow:

 - (Optional) Write a new benchmark in `tests/benchmark`.
 - Run `vendor/bin/phpbench run --tag=before` before making a change.
 - Change the code as you like.
 - Run `vendor/bin/phpbench run --ref=before` to compare performance with the
   tagged run.

Check out the [phpbench documentation](https://phpbench.readthedocs.io/en/latest/index.html)
for more information.

[data provider]: https://docs.phpunit.de/en/12.5/writing-tests-for-phpunit.html#data-providers "PHPUnit Data Providers"
[open an issue]: http://github.com/Respect/Validation/issues
[pull requests]: http://help.github.com/pull-requests "GitHub pull requests"
