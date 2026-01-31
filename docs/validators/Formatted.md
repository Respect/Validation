<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Formatted

- `Formatted(Formatter $formatter, Validator $validator)`

Decorates a validator to format input values in error messages while still validating the original input.

```php
use Respect\StringFormatter\FormatterBuilder as f;

v::formatted(f::mask('1-4'), v::email())->assert('foo@example.com');
// Validation passes successfully

v::formatted(f::mask('1-4'), v::email())->assert('not an email');
// → "****an email" must be an email address

v::formatted(f::pattern('#### #### #### ####'), v::creditCard())->assert('4111111111111111');
// Validation passes successfully

v::formatted(f::pattern('#### #### #### ####'), v::creditCard())->assert('1234123412341234');
// → "1234 1234 1234 1234" must be a credit card number
```

This validator is useful for displaying formatted values in error messages, making them more readable for end users. For example, showing credit card numbers with spaces or phone numbers with proper formatting.

It uses [respect/string-formatter](https://github.com/Respect/StringFormatter) as the underlying formatting engine. See the [StringFormatter documentation](https://github.com/Respect/StringFormatter) for available formatters.

## Behavior

The validator first ensures the input is a valid string using `StringVal`. If the input passes string validation, it validates the original input using the inner validator. The formatted version is only used for display in error messages.

## Categorization

- Display
- Transformations

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Masked](Masked.md)
- [Named](Named.md)
- [Templated](Templated.md)
