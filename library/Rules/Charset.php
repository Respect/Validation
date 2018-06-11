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
use function array_filter;
use function in_array;
use function is_array;
use function mb_detect_encoding;
use function mb_list_encodings;

/**
 * Validates if a string is in a specific charset.
 *
 * @author Alexandre Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Charset extends AbstractRule
{
    /**
     * @var mixed The list of or a character encoding name
     */
    public $charset = null;

    /**
     * @param mixed The list of or a character encoding name
     */
    public function __construct($charset)
    {
        $available = mb_list_encodings();
        $charset = is_array($charset) ? $charset : [$charset];
        $charset = array_filter($charset, function ($c) use ($available) {
            return in_array($c, $available, true);
        });

        if (!$charset) {
            throw new ComponentException(
                'Invalid charset'
            );
        }
        $this->charset = $charset;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $detectedEncoding = mb_detect_encoding($input, $this->charset, true);

        return in_array($detectedEncoding, $this->charset, true);
    }
}
