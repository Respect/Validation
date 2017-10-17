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

class Phone extends AbstractRegexRule
{
    protected function getPregFormat()
    {
        return $this->replaceParams(
            '/^\+?({part1})? ?(?(?=\()(\({part2}\) ?{part3})|([. -]?({part2}[. -]*)?{part3}))$/',
            [
                'part1' => '\d{0,3}',
                'part2' => '\d{1,3}',
                'part3' => '((\d{3,5})[. -]?(\d{4})|(\d{2}[. -]?){4})',
            ]
        );
    }

    private function replaceParams($format, array $params)
    {
        $string = $format;
        foreach ($params as $name => $value) {
            $string = str_replace('{'.$name.'}', $value, $string);
        }

        return $string;
    }
}
