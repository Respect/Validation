<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Handling exceptions

Both `ValidatorBuilder::assert()` and `ValidatorBuilder::check()` throw a `ValidationException` when validation fails. This exception provides detailed feedback on what went wrong.

The difference between the two methods is that `assert()` evaluates all validators in the chain and collects every error, while `check()` stops at the first failure (using `ShortCircuit` internally).

## The `ValidationException`

The `ValidationException` extends PHP's default `InvalidArgumentException`. That means you can simply catch `InvalidArgumentException`.

```php
try {
    v::alnum()->assert($input);
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
```

The same applies to `check()`:

```php
try {
    v::alnum()->lowercase()->check($input);
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage(); // Only the first failure
}
```

### Helpful stack traces

When an exception is thrown, PHP reports where it was *created*, not where it was *caused*. In most validation libraries that means stack traces point deep inside library internals. You end up hunting through the trace to find your actual code.

Although the `ValidationException` is thrown deep inside Validation's internals, we overwrite the stack trace to provide a helpful message. If `v::intType()->assert($input)` fails in `/opt/example.php` line `78`, your stack trace looks like this:

```no-highlight
Stack trace:
#0 /opt/example.php(78): Respect\Validation\Validator->assert(1.0)
#1 {main}
```

### Exception message

The `getMessage()` method returns the message from the first failed validator.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder as v;

try {
    v::alnum()->lowercase()->assert('The Panda');
} catch (ValidationException $exception) {
    echo $exception->getMessage();
}
```

The code above generates the following output:

```no-highlight
"The Panda" must consist only of letters (a-z) and digits (0-9)
```

### Full exception message

The `getFullMessage()` method will return a full comprehensive explanation of validators that didn't pass in a nested Markdown list format.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder as v;

try {
    v::alnum()->lowercase()->assert('The Panda');
} catch (ValidationException $exception) {
    echo $exception->getFullMessage();
}
```

The code above generates the following output:

```no-highlight
- "The Panda" must pass all the rules
  - "The Panda" must consist only of letters (a-z) and digits (0-9)
  - "The Panda" must consist only of lowercase letters
```

### Full exception messages as an array

Retrieve validation messages in array format using `getMessages()`.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder as v;

try {
    v::alnum()->lowercase()->assert('The Panda');
} catch (ValidationException $exception) {
    print_r($exception->getMessages());
}
```

The code above generates the following output:

```no-highlight
Array
(
    [__root__] => "The Panda" must pass all the rules
    [alnum] => "The Panda" must consist only of letters (a-z) and digits (0-9)
    [lowercase] => "The Panda" must consist only of lowercase letters
)
```

When validating with [Key](validators/Key.md) or [Property](validators/Property.md), the keys will correspond to the name of the key or property that failed the validation.

## Custom exception

You can pass a custom exception as the second argument of `ValidatorBuilder::assert()` in two ways.

### Custom exception as object

Pass a `Throwable` to throw a custom exception instead of `ValidationException`.

```php
use Respect\Validation\ValidatorBuilder as v;

try {
    v::alnum()->assert($input, new DomainValidationException('Validation failed!'));
} catch (DomainValidationException $exception) {
     echo $exception->getMessage();
}
```

### Custom exception as callable

Pass a callable to intercept the `ValidationException` before throwing your own exception.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder as v;

try {
    v::alnum()->assert(
        $input,
        fn (ValidationException $exception) => new DomainException(
            'Validation error: ' . $exception->getMessage(),
            $exception->getCode(),
            $exception
        )
    );
} catch (DomainException $exception) {
     echo $exception->getMessage();
}
```

## Custom templates

The `assert()` method accepts different types of templates as the second argument to customize exception messages.

### Custom templates as string

Pass a single string template to replace the root message of the exception.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder as v;

try {
    v::alnum()->assert('The Panda', 'Invalid username provided');
} catch (ValidationException $exception) {
     echo $exception->getFullMessage();
}
```

The code above generates the following output.

```no-highlight
- Invalid username provided
```

### Custom templates as array

Pass custom templates as an array to the `assert()` method for one-off use cases.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder as v;

try {
    v::alnum()
        ->lowercase()
        ->assert(
            'The Panda',
            [
                '__root__' => 'The given input is not valid',
                'alnum' => 'Your username must consist only of letters and digits',
                'lowercase' => 'Your username must be lowercase',
            ]
        );
} catch (ValidationException $exception) {
    print_r($exception->getMessages());
}
```

The code above generates the following output.

```no-highlight
Array
(
    [__root__] => The given input is not valid
    [alnum] => Your username must consist only of letters and digits
    [lowercase] => Your username must be lowercase
)
```

### Custom templates with Templated validator

Use the [Templated](validators/Templated.md) validator to attach templates directly to the chain. That way your chain of validators will always have the same template.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder as v;

try {
    v::templated('Invalid email address', v::email())
        ->assert('not an email');
} catch (ValidationException $exception) {
     echo $exception->getMessage();
}
```

The code above generates the following output.

```no-highlight
Invalid email address
```

You can also use `Templated` with template parameters to create dynamic messages.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder as v;

try {
    v::templated(
        'The author of the page {{title}} is empty',
        v::notBlank(),
        ['title' => 'Feature Guide']
    )->assert('');
} catch (ValidationException $exception) {
     echo $exception->getMessage();
}
```

The code above generates the following output.

```no-highlight
The author of the page "Feature Guide" is empty
```
