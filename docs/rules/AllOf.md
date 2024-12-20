# AllOf

- `AllOf(Rule $rule1, Rule $rule2, Rule ...$rule)`

Will validate if all inner validators validates.

```php
v::allOf(v::intVal(), v::positive())->isValid(15); // true
```

## Templates

### `AllOf::TEMPLATE_SOME`

| Mode       | Template                               |
|------------|----------------------------------------|
| `default`  | These rules must pass for {{name}}     |
| `inverted` | These rules must not pass for {{name}} |

### `AllOf::TEMPLATE_NONE`

| Mode       | Template                                         |
|------------|--------------------------------------------------|
| `default`  | All of the required rules must pass for {{name}} |
| `inverted` | None of these rules must pass for {{name}}       |

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
