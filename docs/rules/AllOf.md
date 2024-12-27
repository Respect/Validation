# AllOf

- `AllOf(Rule $rule1, Rule $rule2, Rule ...$rule)`

Will validate if all inner validators validates.

```php
v::allOf(v::intVal(), v::positive())->isValid(15); // true
```

## Templates

### `AllOf::TEMPLATE_SOME`

Used when some rules must be failed.

| Mode       | Template                     |
|------------|------------------------------|
| `default`  | {{name}} must pass the rules |
| `inverted` | {{name}} must pass the rules |

### `AllOf::TEMPLATE_ALL`

Used when all rules have failed.

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

- [AnyOf](AnyOf.md)
- [Circuit](Circuit.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
