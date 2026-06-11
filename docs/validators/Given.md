<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Given

- `Given(Validator $when, Validator $then)`

A conditional validator. When `$when` passes, validates `$then`; otherwise passes silently.

```php
v::given(v::intVal(), v::positive())->assert(5);
// Validation passes successfully

v::given(v::intVal(), v::positive())->assert('non-integer');
// Validation passes successfully

v::given(v::intVal(), v::positive())->assert(-1);
// → -1 must be a positive number
```

In the sample above, if `$input` is an integer, then it must be positive.
If `$input` is not an integer, validation passes silently — there is no `$else` branch.

This makes `Given` ideal inside `AllOf` or `ShortCircuit` chains where "skip when irrelevant" is the desired behavior.

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Conditions
- Nesting

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.2.0 | Created     |

## See Also

- [AllOf](AllOf.md)
- [AlwaysValid](AlwaysValid.md)
- [AnyOf](AnyOf.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [ShortCircuit](ShortCircuit.md)
- [When](When.md)
