# Url

- `Url()`

Validates whether the input is a URL.

```php
v::url()->isValid('http://example.com'); // true
v::url()->isValid('https://www.youtube.com/watch?v=6FOUqQt3Kg0'); // true
v::url()->isValid('ldap://[::1]'); // true
v::url()->isValid('mailto:john.doe@example.com'); // true
v::url()->isValid('news:new.example.com'); // true
```

## Changelog

Version | Description
--------|-------------
  0.8.0 | Created

***
See also:

- [Domain](Domain.md)
- [Email](Email.md)
- [FilterVar](FilterVar.md)
- [Phone](Phone.md)
- [VideoUrl](VideoUrl.md)
