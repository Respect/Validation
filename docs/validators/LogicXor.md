# LogicXor

- `LogicXor(Validator $validator1, Validator $validator2, Validator ...$validator)`

Validates that exactly one inner validator passes, applying XOR logic.

```php
v::logicXor(v::digit(), v::alpha())->isValid('AB'); // true
v::logicXor(v::digit(), v::alpha())->isValid('12'); // true
v::logicXor(v::digit(), v::alpha())->isValid('AB12'); // false
v::logicXor(v::digit(), v::alpha())->isValid('*'); // false
```

The chains above validate if the input is either a digit or an alphabetic
character, one or the other, but not neither nor both.

## Templates

### `LogicXor::TEMPLATE_NONE`

Used when none of the validators have passed.

| Mode       | Template                               |
| ---------- | -------------------------------------- |
| `default`  | {{subject}} must pass one of the rules |
| `inverted` | {{subject}} must pass one of the rules |

### `LogicXor::TEMPLATE_MORE_THAN_ONE`

Used when more than one validator has passed.

| Mode       | Template                                    |
| ---------- | ------------------------------------------- |
| `default`  | {{subject}} must pass only one of the rules |
| `inverted` | {{subject}} must pass only one of the rules |

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
|   3.0.0 | Require at least two validators and renamed to `LogicXor` |
|   0.3.9 | Created as `OneOf`                                        |

---

See also:

- [Circuit](Circuit.md)
- [LogicAnd](LogicAnd.md)
- [LogicNor](LogicNor.md)
- [LogicOr](LogicOr.md)
- [When](When.md)
