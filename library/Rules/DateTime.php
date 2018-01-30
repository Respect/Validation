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

use function is_scalar;
use function strtotime;
use DateTimeInterface;
use Respect\Validation\Helpers\DateTimeHelper;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DateTime extends AbstractRule
{
    use DateTimeHelper;

    /**
     * @var string|null
     */
    private $format;

    /**
     * Initializes the rule.
     *
     * @param string|null $format
     */
    public function __construct(string $format = null)
    {
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof DateTimeInterface) {
            return null === $this->format;
        }

        if (!is_scalar($input)) {
            return false;
        }

        if (null === $this->format) {
            return false !== strtotime((string) $input);
        }

        return $this->isDateTime($this->format, (string) $input);
    }
}
