# OneOf

- `OneOf(Validator $validator1, Validator $validator2, Validator ...$validator)`

Will validate if exactly one inner validator passes.

```php
v::oneOf(v::digit(), v::alpha())->isValid('AB'); // true
v::oneOf(v::digit(), v::alpha())->isValid('12'); // true
v::oneOf(v::digit(), v::alpha())->isValid('AB12'); // false
v::oneOf(v::digit(), v::alpha())->isValid('*'); // false
```

The chains above validate if the input is either a digit or an alphabetic
character, one or the other, but not neither nor both.

## Templates

### `OneOf::TEMPLATE_NONE`

Used when none of the validators have passed.

| Mode       | Template                               |
| ---------- | -------------------------------------- |
| `default`  | {{subject}} must pass one of the rules |
| `inverted` | {{subject}} must pass one of the rules |

### `OneOf::TEMPLATE_MORE_THAN_ONE`

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
- [LogicAnd](LogicAnd.md)
- [NoneOf](NoneOf.md)
- [When](When.md)
