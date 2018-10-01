# Isbn

- `v::Isbn()`

Validates whether the type of an input is Isbn (International Standard Book Number).

```php
v::Isbn()->validate('ISBN-13: 978-0-596-52068-7'); // true
v::Isbn()->validate('978 0 596 52068 7'); // true
v::Isbn()->validate('9780596520687'); // true
v::Isbn()->validate('0-596-52068-9'); // true
v::Isbn()->validate('0 512 52068 9'); // true
v::Isbn()->validate('ISBN-10 0-596-52068-9'); // true
v::Isbn()->validate('ISBN-10: 0-596-52068-9'); // true

v::Isbn()->validate('ISBN 11978-0-596-52068-7'); // false 
v::Isbn()->validate('ISBN-12: 978-0-596-52068-7'); // false 
v::Isbn()->validate('978 10 596 52068 7'); // false
v::Isbn()->validate('119780596520687'); // false
v::Isbn()->validate('0-5961-52068-9'); // false 
v::Isbn()->validate('11 5122 52068 9'); // false 
v::Isbn()->validate('ISBN-11 0-596-52068-9'); // false
v::Isbn()->validate('ISBN-10- 0-596-52068-9'); // false
v::Isbn()->validate('Defiatly no ISBN'); // false
v::Isbn()->validate('Neither ISBN-13: 978-0-596-52068-7'); // false
```
