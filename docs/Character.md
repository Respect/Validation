# Character

- `v::character(string $countryCode)`

Validates if an input includes language specific characters.

```php
v::character('TR')->validate("Mustafa Kemal Atatürk"); //true
v::character('TR')->validate("Ahmet"); //false
```

These country codes are supported:

 * "TR" (Turkey)
