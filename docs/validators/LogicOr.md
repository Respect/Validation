# LogicOr

- `LogicOr(Validator $validator1, Validator $validator2, Validator ...$validator)`

Validates that at least one inner validator passes, applying OR logic.

```php
v::logicOr(v::intVal(), v::floatVal())->isValid(15.5); // true
```

In the sample above, `IntVal()` doesn't validates, but `FloatVal()` validates,
so `LogicOr()` returns true.

`LogicOr()` returns true if at least one inner validator passes.

## Templates

### `LogicOr::TEMPLATE_STANDARD`

| Mode       | Template                                        |
| ---------- | ----------------------------------------------- |
| `default`  | {{subject}} must pass at least one of the rules |
| `inverted` | {{subject}} must pass at least one of the rules |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Composite
- Logical
- Nesting

## Changelog

| Version | Description                                              |
| ------: | -------------------------------------------------------- |
|   3.0.0 | Require at least two validators and renamed to `LogicOr` |
|   2.0.0 | Created as `AnyOf`                                       |

---

See also:

- [Circuit](Circuit.md)
- [ContainsAny](ContainsAny.md)
- [LogicAnd](LogicAnd.md)
- [LogicNor](LogicNor.md)
- [LogicXor](LogicXor.md)
- [When](When.md)
