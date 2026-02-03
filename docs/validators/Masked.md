<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Masked

- `Masked(string $range, Validator $validator)`
- `Masked(string $range, Validator $validator, string $replacement)`

Decorates a validator to mask input values in error messages while still validating the original unmasked input.

```php
v::masked('1-@', v::email())->assert('foo@example.com');
// Validation passes successfully

v::masked('1-@', v::email())->assert('invalid username@domain.com');
// → "****************@domain.com" must be a valid email address

v::masked('1-', v::lengthGreaterThan(10))->assert('password');
// → The length of "********" must be greater than 10

v::masked('6-12', v::creditCard(), 'X')->assert('4111111111111211');
// → "41111XXXXXXX1211" must be a valid credit card number
```

This validator is useful for security-sensitive applications where error messages should not expose sensitive data like credit card numbers, passwords, or email addresses.

It uses [respect/string-formatter](https://github.com/Respect/StringFormatter) as the underlying masking engine. See the section the documentation of [MaskFormatter](https://github.com/Respect/StringFormatter/blob/main/docs/MaskFormatter.md) for more information.

## Categorization

- Display
- Miscellaneous

## Behavior

The validator first ensures the input is a valid string using `StringVal`. If the input passes string validation, it validates the original unmasked input using the inner validator. If validation fails, it applies masking to the input value shown in error messages.

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Named](Named.md)
- [Templated](Templated.md)
