# LogicNor

- `LogicNor(Validator $validator1, Validator $validator2, Validator ...$validator)`

Validates that none of the inner validators pass, applying NOR logic.

```php
v::logicNor(
    v::intVal(),
    v::floatVal()
)->isValid('foo'); // true
```

In the sample above, 'foo' isn't a integer nor a float, so logicNor returns true.

## Templates

### `LogicNor::TEMPLATE_SOME`

Used when some validators have passed.

| Mode       | Template                        |
| ---------- | ------------------------------- |
| `default`  | {{subject}} must pass the rules |
| `inverted` | {{subject}} must pass the rules |

### `LogicNor::TEMPLATE_ALL`

Used when all validators have passed.

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
|   3.0.0 | Require at least two validators and renamed to `LogicNor` |
|   0.3.9 | Created as `NoneOf`                                       |

---

See also:

- [Circuit](Circuit.md)
- [LogicAnd](LogicAnd.md)
- [LogicOr](LogicOr.md)
- [LogicXor](LogicXor.md)
- [Not](Not.md)
- [When](When.md)
