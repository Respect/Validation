# Domain

- `v::domain()`
- `v::domain(boolean $tldCheck = true)`

Validates domain names.

```php
v::domain()->validate('google.com');
```

You can skip *top level domain* (TLD) checks to validate internal
domain names:

```php
v::domain(false)->validate('dev.machine.local');
```

This is a composite validator, it validates several rules
internally:

  * If input is an IP address, it fails.
  * If input contains whitespace, it fails.
  * If input does not contain any dots, it fails.
  * If input has less than two parts, it fails.
  * Input must end with a top-level-domain to pass (if not skipped).
  * Each part must be alphanumeric and not start with an hyphen.
  * [PunnyCode][] is accepted for [Internationalizing Domain Names in Applications][IDNA].

Messages for this validator will reflect rules above.

***
See also:

  * [Ip](Ip.md)
  * [MacAddress](MacAddress.md)
  * [Tld](Tld.md)

[PunnyCode]: http://en.wikipedia.org/wiki/Punycode "Wikipedia: Punnycode"
[IDNA]: http://en.wikipedia.org/wiki/Internationalized_domain_name#Internationalizing_Domain_Names_in_Applications "Wikipedia: Internationalized domain name"
