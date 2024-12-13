--FILE--
<?php

require 'vendor/autoload.php';

exceptionFullMessage(static fn() => v::each(v::equals(1))->assert(['A', 'B', 'B']));
?>
--EXPECT--
- Each item in `["A", "B", "B"]` must be valid
  - "A" must be equal to 1
  - "B" must be equal to 1
  - "B" must be equal to 1