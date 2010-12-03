<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AtLeastException;

class AtLeast extends AbstractComposite
{

    protected $howMany = 1;

    public function __construct($howMany, $rules=array())
    {
        $this->howMany = $howMany;
        $this->addRules($rules);
    }

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        if ($this->howMany > (count($validators) - count($exceptions)))
            throw $this->getException() ? : AtLeastException::create()
                    ->configure($input, count($exceptions), $this->howMany)
                    ->setRelated($exceptions);
        return true;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        $pass = 0;
        foreach ($validators as $v) {
            try {
                $v->check($input);
                $pass++;
            } catch (ValidationException $e) {
                //no need to do anything here. We just wanna count 
                //how many rules passed
            }
            if ($pass >= $this->howMany)
                return true;
        }
        return false;
    }

    public function check($input)
    {
        $validators = $this->getRules();
        $pass = 0;
        $exceptions = array();
        foreach ($validators as $v) {
            try {
                $v->check($input);
                $pass++;
            } catch (ValidationException $e) {
                $exceptions[] = $e;
            }
            if ($pass >= $this->howMany)
                return true;
            if (count($exceptions) > (count($validators) - $this->howMany))
                throw $this->getException() ? : AtLeastException::create()
                        ->setRelated($exceptions)
                        ->configure($input, count($exceptions), $this->howMany);
        }
        return false;
    }

}