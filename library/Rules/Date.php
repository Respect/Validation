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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Helpers\DateTimeHelper;
use function is_scalar;
use function preg_match;
use function sprintf;

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
     * @var string
     */
    private $sample;

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
        $this->sample = date($format, strtotime('2005-12-30'));
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
