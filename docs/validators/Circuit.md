<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Circuit

- `Circuit(Validator $validator1, Validator $validator2)`
- `Circuit(Validator $validator1, Validator $validator2, Validator ...$validators)`

Validates the input against a series of validators until the first fails.

This validator can be handy for getting the least error messages possible from a chain.

This validator can be helpful in combinations with [Lazy](Lazy.md). An excellent example is when you want to validate a
country code and a subdivision code.

```php
$validator = v::circuit(
    v::key('countryCode', v::countryCode()),
    v::lazy(static fn($input) => v::key('subdivisionCode', v::subdivisionCode($input['countryCode']))),
);

$validator->assert([]);
// → `.countryCode` must be present

$validator->assert(['countryCode' => 'US']);
// → `.subdivisionCode` must be present

$validator->assert(['countryCode' => 'US', 'subdivisionCode' => 'ZZ']);
// → `.subdivisionCode` must be a subdivision code of United States

$validator->assert(['countryCode' => 'US', 'subdivisionCode' => 'CA']);
// Validation passes successfully
```

You need a valid country code to create a [SubdivisionCode](SubdivisionCode.md), so it makes sense only to validate the
subdivision code only if the country code is valid. In this case, you could also have used [When](When.md), but you
would then have to write `v::key('countryCode', v::countryCode())` twice in your chain.

## Templates

This validator does not have any templates, because it will always return the result of the first validator that fails. When all the validators pass, it will return the result of the last validator of the circuit.

## Categorization

- Composite
- Conditions
- Nesting

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [AllOf](AllOf.md)
- [AnyOf](AnyOf.md)
- [Lazy](Lazy.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [SubdivisionCode](SubdivisionCode.md)
- [When](When.md)
