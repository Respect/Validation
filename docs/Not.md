# Not

- `v::not(v $negatedValidator)`

Negates any rule.

```php
v::not(v::ip())->validate('foo'); //true
```

using a shortcut

```php
v::ip()->not()->validate('foo'); //true
```

In the sample above, validator returns true because 'foo' isn't an IP Address.

You can negate complex, grouped or chained validators as well:

```php
v::not(v::int()->positive())->validate(-1.5); //true
```

using a shortcut

```php
v::int()->positive()->not()->validate(-1.5); //true
```

Each other validation has custom messages for negated rules.

See also:

  * [NoneOf](NoneOf.md)
