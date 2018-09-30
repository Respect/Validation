# ISBN

- `v::ISBN()`

Validates whether the type of an input is ISBN (International Standard Book Number).

```php
v::ISBN()->validate('ISBN-13: 978-0-596-52068-7'); // true
v::ISBN()->validate('978 0 596 52068 7'); // true
v::ISBN()->validate('9780596520687'); // true
v::ISBN()->validate('0-596-52068-9'); // true
v::ISBN()->validate('0 512 52068 9'); // true
v::ISBN()->validate('ISBN-10 0-596-52068-9'); // true
v::ISBN()->validate('ISBN-10: 0-596-52068-9'); // true

v::ISBN()->validate('ISBN 11978-0-596-52068-7'); // false 
v::ISBN()->validate('ISBN-12: 978-0-596-52068-7'); // false 
v::ISBN()->validate('978 10 596 52068 7'); // false
v::ISBN()->validate('119780596520687'); // false
v::ISBN()->validate('0-5961-52068-9'); // false 
v::ISBN()->validate('11 5122 52068 9'); // false 
v::ISBN()->validate('ISBN-11 0-596-52068-9'); // false
v::ISBN()->validate('ISBN-10- 0-596-52068-9'); // false
v::ISBN()->validate('Defiatly no ISBN'); // false
v::ISBN()->validate('Neither ISBN-13: 978-0-596-52068-7'); // false
```
