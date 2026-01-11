# AllOf

- `AllOf(Validator $validator1, Validator $validator2)`
- `AllOf(Validator $validator1, Validator $validator2, Validator ...$validators)`

Will validate if all inner validators validates.

```php
v::allOf(v::intVal(), v::positive())->isValid(15); // true
```

## Templates

### `AllOf::TEMPLATE_SOME`

Used when some validators must be failed.

| Mode       | Template                        |
| ---------- | ------------------------------- |
| `default`  | {{subject}} must pass the rules |
| `inverted` | {{subject}} must pass the rules |

### `AllOf::TEMPLATE_ALL`

Used when all validators have failed.

| Mode       | Template                            |
| ---------- | ----------------------------------- |
| `default`  | {{subject}} must pass all the rules |
| `inverted` | {{subject}} must pass all the rules |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Composite
- Nesting

## Changelog

| Version | Description                                  |
| ------: | -------------------------------------------- |
|   3.0.0 | Require at least two validators to be passed |
|   0.3.9 | Created                                      |

---

See also:

- [AnyOf](AnyOf.md)
- [Circuit](Circuit.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
