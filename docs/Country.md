# Country

- `v::country()`
- `v::country(string $set)`

Validates country codes according to [ISO 3166-1][].

```php
v::country()->validate('BR'); //true
```

By default we choose [ISO 3166-1 alpha-2][] but you can use [ISO 3166-1 alpha-3][]
and [ISO 3166-1 numeric][] as well.

```php
v::country('alpha-2')->validate('US'); //true
v::country('alpha-3')->validate('USA'); //true
v::country('numeric')->validate('840'); //true
```

This rule is case sensitive.

See also:

  * [Tld](Tld.md)


[ISO 3166-1]: http://en.wikipedia.org/wiki/ISO_3166-1 "ISO 3166-1"
[ISO 3166-1 alpha-2]: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 "ISO 3166-1 alpha-2"
[ISO 3166-1 alpha-3]: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-3 "ISO 3166-1 alpha-3"
[ISO 3166-1 numeric]: http://en.wikipedia.org/wiki/ISO_3166-1_numeric "ISO 3166-1 numeric"
