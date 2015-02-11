<?php
namespace Respect\Validation\Rules;

class Max extends AbstractInterval
{
    public function validate($input)
    {
        if ($this->inclusive) {
            return $this->filterInterval($input) <= $this->filterInterval($this->interval);
        }

        return $this->filterInterval($input) < $this->filterInterval($this->interval);
    }
}
