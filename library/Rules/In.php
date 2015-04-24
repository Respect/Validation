<?php
namespace Respect\Validation\Rules;

class In extends AbstractSearcher
{
    public $haystack;
    public $compareIdentical;

    public function __construct($haystack, $compareIdentical = false)
    {
        $this->haystack         = $haystack;
        $this->compareIdentical = $compareIdentical;
    }
}
