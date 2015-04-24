# CountrySubdivision

- `v::countrySubdivision(string $entry)`

Validates country codes according to [ISO 3166-2][].

The `$entry` must be a country in [ISO 3166-1 alpha-2][] format.

```php
v::countrySubdivision('BR')->validate('SP'); //true
v::countrySubdivision('US')->validate('CA'); //true
```

This rule is case sensitive.

All data was extrated from [GeoNames][] which is licensed under a
[Creative Commons Attribution 3.0 License][].

See also:

  * [Country](Country.md)
  * [Tld](Tld.md)


[Creative Commons Attribution 3.0 License]: http://creativecommons.org/licenses/by/3.0 "Creative Commons Attribution 3.0 License"
[GeoNames]: http://www.geonames.org "GetNames"
[ISO 3166-1 alpha-2]: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 "ISO 3166-1 alpha-2"
[ISO 3166-2]: http://en.wikipedia.org/wiki/ISO_3166-2 "ISO 3166-2"
