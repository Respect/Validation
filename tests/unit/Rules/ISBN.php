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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\ISBN
 */
class ISBNTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $rule = new ISBN();

        return [
            [$rule, 'ISBN-13: 978-0-596-52068-7'],
            [$rule, '978 0 596 52068 7'],
            [$rule, '9780596520687'],
            [$rule, '0-596-52068-9'],
            [$rule, '0 512 52068 9'],
            [$rule, 'ISBN-10 0-596-52068-9'],
            [$rule, 'ISBN-10: 0-596-52068-9'],           
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new ISBN();

        return [
            [$rule, 'ISBN 11978-0-596-52068-7'], 
            [$rule, 'ISBN-12: 978-0-596-52068-7'], 
            [$rule, '978 10 596 52068 7'],
            [$rule, '119780596520687'],
            [$rule, '0-5961-52068-9'], 
            [$rule, '11 5122 52068 9'], 
            [$rule, 'ISBN-11 0-596-52068-9'],
            [$rule, 'ISBN-10- 0-596-52068-9'],
            [$rule, 'Defiatly no ISBN'],
            [$rule, 'Neither ISBN-13: 978-0-596-52068-7'],
        ];
    }
}
