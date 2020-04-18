<?php
declare(strict_types=1);

namespace Custom\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * Class CustomRule
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
final class CustomRule extends AbstractRule
{
    /**
     * @var bool
     */
    private $shouldPass;

    public function __construct(bool $shouldPass = false)
    {
        $this->shouldPass = $shouldPass;
    }

    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input): bool
    {
        return $this->shouldPass;
    }
}