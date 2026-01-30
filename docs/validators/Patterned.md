<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Patterned

- `Patterned(string $pattern, Validator $validator)`

Decorates a validator to format input values using a pattern in error messages while still validating the original unformatted input.

```php
v::patterned('0000 0000 0000 0000', v::creditCard())->assert('4111111111111111');
// Validation passes successfully

v::patterned('0000 0000 0000 0000', v::creditCard())->assert('4111111111111112');
// → "4111 1111 1111 1112" must be a valid credit card number

v::patterned('0{3}.0{3}.0{3}-0{2}', v::cpf())->assert('12345678900');
// → "123.456.789-00" must be a valid CPF number

v::patterned('(0{2}) 0{5}-0{4}', v::phone())->assert('11987654321');
// → "(11) 98765-4321" must be a valid telephone number
```

This validator is useful for displaying formatted values in error messages when the original input lacks formatting characters.

It uses [respect/string-formatter](https://github.com/Respect/StringFormatter) as the underlying formatting engine. See the documentation of [PatternFormatter](https://github.com/Respect/StringFormatter/blob/main/docs/PatternFormatter.md) for more information about the pattern syntax.

## Categorization

- Display
- Miscellaneous

## Behavior

The validator first ensures the input is a valid string using `StringVal`. If the input passes string validation, it validates the original unformatted input using the inner validator. If validation fails, it applies the pattern formatting to the input value shown in error messages.

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Masked](Masked.md)
- [Named](Named.md)
- [Templated](Templated.md)
