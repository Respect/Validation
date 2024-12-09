# OneOf

- `OneOf(Rule $rule1, Rule $rule2, Rule ...$rule)`

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

### `OneOf::TEMPLATE_STANDARD`

| Mode       | Template                                           |
|------------|----------------------------------------------------|
| `default`  | Only one of these rules must pass for {{name}}     |
| `inverted` | Only one of these rules must not pass for {{name}} |

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
- [Consecutive](Consecutive.md)
- [NoneOf](NoneOf.md)
- [When](When.md)
