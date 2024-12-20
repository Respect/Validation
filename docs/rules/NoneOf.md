# NoneOf

- `NoneOf(Rule $rule1, Rule $rule2, Rule ...$rule)`

Validates if NONE of the given validators validate:

```php
v::noneOf(
    v::intVal(),
    v::floatVal()
)->isValid('foo'); // true
```

In the sample above, 'foo' isn't a integer nor a float, so noneOf returns true.

## Templates

### `NoneOf::TEMPLATE_STANDARD`

| Mode       | Template                                   |
|------------|--------------------------------------------|
| `default`  | None of these rules must pass for {{name}} |
| `inverted` | All of these rules must pass for {{name}}  |

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
|   0.3.9 | Created                                 |

***
See also:

- [AllOf](AllOf.md)
- [AnyOf](AnyOf.md)
- [Circuit](Circuit.md)
- [Not](Not.md)
- [OneOf](OneOf.md)
- [When](When.md)
