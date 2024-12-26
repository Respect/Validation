# Not

- `Not(Rule $rule)`

Negates any rule.

```php
v::not(v::ip())->isValid('foo'); // true
```

In the sample above, validator returns true because 'foo' isn't an IP Address.

You can negate complex, grouped or chained validators as well:

```php
v::not(v::intVal()->positive())->isValid(-1.5); // true
```

Each other validation has custom messages for negated rules.

## Templates

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Core
- Conditions
- Nesting

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [NoneOf](NoneOf.md)
- [Templated](Templated.md)
