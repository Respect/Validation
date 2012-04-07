<?php
namespace Respect\Validation\Rules;

/**
 * @link http://semver.org/
 */
class Version extends AbstractRule
{

    public function validate($input)
    {
        $pattern = '/^[0-9]+\.[0-9]+\.[0-9]+([+-][^+-][0-9A-Za-z-.]*)?$/';
        return (bool) preg_match($pattern, $input);
    }


}

