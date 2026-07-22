# Cnpj

- `Cnpj()`

Validates if the input is a Brazilian National Registry of Legal Entities (CNPJ) number.

Since 2026 the CNPJ can be alphanumeric: the first twelve positions may contain the
letters `A` to `Z` as well as digits, while the last two (the check digits) remain numeric.
Non-alphanumeric chars (such as `.`, `/` and `-`) are ignored, so use `->digit()` if needed.

## Categorization

- Identifications

## Changelog

Version | Description
--------|-------------
  2.5.0 | Added support for alphanumeric CNPJ
  0.3.9 | Created

***
See also:

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cpf](Cpf.md)
- [Imei](Imei.md)
- [NfeAccessKey](NfeAccessKey.md)
- [Nif](Nif.md)
- [Pis](Pis.md)
- [PortugueseNif](PortugueseNif.md)
