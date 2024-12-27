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

### `NoneOf::TEMPLATE_SOME`

Used when some rules have passed.

| Mode       | Template                     |
|------------|------------------------------|
| `default`  | {{name}} must pass the rules |
| `inverted` | {{name}} must pass the rules |

### `NoneOf::TEMPLATE_ALL`

Used when all rules have passed.

| Mode       | Template                         |
|------------|----------------------------------|
| `default`  | {{name}} must pass all the rules |
| `inverted` | {{name}} must pass all the rules |

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
