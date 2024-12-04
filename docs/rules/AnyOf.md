# AnyOf

- `AnyOf(Rule $rule1, Rule $rule2, Rule ...$rule)`

This is a group validator that acts as an OR operator.

```php
v::anyOf(v::intVal(), v::floatVal())->isValid(15.5); // true
```

In the sample above, `IntVal()` doesn't validates, but `FloatVal()` validates,
so `AnyOf()` returns true.

`AnyOf()` returns true if at least one inner validator passes.

## Templates

`AnyOf::TEMPLATE_STANDARD`

| Mode       | Template                                               |
|------------|--------------------------------------------------------|
| `default`  | At least one of these rules must pass for {{name}}     |
| `inverted` | At least one of these rules must not pass for {{name}} |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Composite
- Nesting

## Changelog

| Version | Description                             |
|--------:|-----------------------------------------|
|   3.0.0 | Require at least two rules to be passed |
|   2.0.0 | Created                                 |

***
See also:

- [AllOf](AllOf.md)
- [Consecutive](Consecutive.md)
- [ContainsAny](ContainsAny.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
