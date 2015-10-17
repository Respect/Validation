--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CallableTypeException;

try {
  v::not(v::callableType())->check(array()); 
} catch (CallableTypeException $exception) {  
  echo $exception->getFullMessage();
}

try {
  v::not(v::callableType())->check('oneInexistentFunction'); 
} catch (CallableTypeException $exception) {  
  echo $exception->getFullMessage();
}

try {
  v::not(v::callableType())->check(100); 
} catch (CallableTypeException $exception) {  
  echo $exception->getFullMessage();
}

try {
  v::not(v::callableType())->check(null); 
} catch (CallableTypeException $exception) {  
  echo $exception->getFullMessage();
}

try {
  v::not(v::callableType())->check(''); 
} catch (CallableTypeException $exception) {  
  echo $exception->getFullMessage();
}
?>
--EXPECTF--