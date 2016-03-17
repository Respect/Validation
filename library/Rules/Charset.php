<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

class Charset extends AbstractRule
{
    public $charset = null;

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

    public function validate($input)
    {
        $detectedEncoding = mb_detect_encoding($input, $this->charset, true);

        return in_array($detectedEncoding, $this->charset, true);
    }
}
