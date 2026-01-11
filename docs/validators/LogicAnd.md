# LogicAnd

- `LogicAnd(Validator $validator1, Validator $validator2, Validator ...$validator)`

Validates that all inner validators pass, applying AND logic.

```php
v::logicAnd(v::intVal(), v::positive())->isValid(15); // true
```

## Templates

### `LogicAnd::TEMPLATE_SOME`

Used when some validators must be failed.

| Mode       | Template                        |
| ---------- | ------------------------------- |
| `default`  | {{subject}} must pass the rules |
| `inverted` | {{subject}} must pass the rules |

### `LogicAnd::TEMPLATE_ALL`

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
- Logical
- Nesting

## Changelog

| Version | Description                                               |
| ------: | --------------------------------------------------------- |
|   3.0.0 | Require at least two validators and renamed to `LogicAnd` |
|   0.3.9 | Created as `AllOf`                                        |

---

See also:

- [Circuit](Circuit.md)
- [LogicOr](LogicOr.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
