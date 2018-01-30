<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function date_parse_from_format;
use function is_scalar;
use function preg_match;
use function sprintf;
use Respect\Validation\Helpers\DateTimeHelper;
use Respect\Validation\Exceptions\ComponentException;

/**
 * Validates if input is a date.
 *
 * @author Bruno Luiz da Silva <contato@brunoluiz.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Date extends AbstractRule
{
    use DateTimeHelper;

    /**
     * @var string
     */
    private $format;

    /**
     * Initializes the rule.
     *
     * @param string $format
     *
     * @throws ComponentException
     */
    public function __construct(string $format = 'Y-m-d')
    {
        if (!preg_match('/^[djSFmMnYy\W]+$/', $format)) {
            throw new ComponentException(sprintf('"%s" is not a valid date format', $format));
        }

        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return $this->isDateTime($this->format, (string) $input);
    }
}
