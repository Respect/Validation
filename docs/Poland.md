# Poland specific documents or numbers

## Pesel

- `v::poland('Pesel')`

Validates PESEL (Polish human identification number).

```php
v::poland('Pesel')->validate('21120209256'); // true
v::poland('Pesel')->validate('97072704800'); // true
v::poland('Pesel')->validate('97072704801'); // false
v::poland('Pesel')->validate('PESEL123456'); // false
```
## IdentityCard

- `v::poland('IdentityCard')`

Validates Polish Identity Card number (Dowód Osobisty).

```php
v::poland('IdentityCard')->validate('AYW036733'); // true
v::poland('IdentityCard')->validate('APH505567'); // true
v::poland('IdentityCard')->validate('APH 505567'); // false
v::poland('IdentityCard')->validate('AYW036731'); // false
```
