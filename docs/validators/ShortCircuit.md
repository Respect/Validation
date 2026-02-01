<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# ShortCircuit

- `ShortCircuit()`
- `ShortCircuit(Validator ...$validators)`

Validates the input against a series of validators, stopping at the first failure.

Like PHP's `&&` operator, it uses short-circuit evaluation: once the outcome is determined, remaining validators are
skipped. Unlike [AllOf](AllOf.md), which evaluates all validators and collects all failures, `ShortCircuit` returns
immediately.

```php
v::shortCircuit(v::intVal(), v::positive())->assert(15);
// Validation passes successfully
```

This is useful when:

- You want only the first error message instead of all of them
- Later validators depend on earlier ones passing (e.g., checking a format before checking a value)
- You want to avoid unnecessary validation work

This validator is particularly useful in combination with [Factory](Factory.md) when later validations depend on earlier
results. For example, validating a subdivision code that depends on a valid country code:

```php
$validator = v::shortCircuit(
    v::key('countryCode', v::countryCode()),
    v::factory(static fn($input) => v::key('subdivisionCode', v::subdivisionCode($input['countryCode']))),
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

Because [SubdivisionCode](SubdivisionCode.md) requires a valid country code, it only makes sense to validate the
subdivision after the country code passes. You could achieve this with [When](When.md), but you would have to repeat
`v::key('countryCode', v::countryCode())` twice.

## Note

The `check()` method in `ValidatorBuilder` uses `ShortCircuit` internally to short-circuit the entire validation chain. Use `ShortCircuit` directly when you need fine-grained control over which specific group of validators should fail fast, while letting the rest of the validation continue collecting errors via `assert()`.

## Templates

This validator does not have templates of its own. It returns the result of the first failing validator, or the result
of the last validator when all pass.

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
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [SubdivisionCode](SubdivisionCode.md)
- [When](When.md)
