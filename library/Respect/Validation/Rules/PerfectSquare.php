<?php

namespace Respect\Validation\Rules;
class PerfectSquare extends AbstractRule
{
public function validate($input)
    {
      if (is_numeric($input)):
        if ((sqrt($input)*sqrt($input))== $input)
            $input = 1;
        else
            $input = 0;
      else:
        $input=0;
      endif;        

    return (boolean)$input;
    
    }
    
}    
?>