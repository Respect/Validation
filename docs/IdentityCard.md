# IdentityCard

- `v::identityCard()`

Validates Polish Identity Card number (Dowód Osobisty).

```php
v::identityCard()->validate('AYW036733'); // true
v::identityCard()->validate('APH505567'); // true
v::identityCard()->validate('APH 505567'); // false
v::identityCard()->validate('AYW036731'); // false
```
