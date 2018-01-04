# Not

- `Not(Rule $rule)`

Negates any rule.

```php
v::not(v::ip())->validate('foo'); // true
```

In the sample above, validator returns true because 'foo' isn't an IP Address.

You can negate complex, grouped or chained validators as well:

```php
v::not(v::intVal()->positive())->validate(-1.5); // true
```

Each other validation has custom messages for negated rules.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [NoneOf](NoneOf.md)
