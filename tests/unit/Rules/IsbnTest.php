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

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Isbn
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Moritz Fromm <moritzgitfromm@gmail.com>
 */
final class IsbnTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new Isbn();

        return [
            [$sut, 'ISBN-13: 978-0-596-52068-7'],
            [$sut, '978 0 596 52068 7'],
            [$sut, '9780596520687'],
            [$sut, '0-596-52068-9'],
            [$sut, '0 512 52068 9'],
            [$sut, 'ISBN-10 0-596-52068-9'],
            [$sut, 'ISBN-10: 0-596-52068-9'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new Isbn();

        return [
            [$sut, 'ISBN 11978-0-596-52068-7'],
            [$sut, 'ISBN-12: 978-0-596-52068-7'],
            [$sut, '978 10 596 52068 7'],
            [$sut, '119780596520687'],
            [$sut, '0-5961-52068-9'],
            [$sut, '11 5122 52068 9'],
            [$sut, 'ISBN-11 0-596-52068-9'],
            [$sut, 'ISBN-10- 0-596-52068-9'],
            [$sut, 'Defiatly no ISBN'],
            [$sut, 'Neither ISBN-13: 978-0-596-52068-7'],
        ];
    }
}
