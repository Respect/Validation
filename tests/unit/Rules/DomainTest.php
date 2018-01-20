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

use PHPUnit\Framework\TestCase;
use Respect\Validation\Validator as v;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Domain
 * @covers \Respect\Validation\Exceptions\DomainException
 */
class DomainTest extends TestCase
{
    protected $object;

    protected function setUp(): void
    {
        $this->object = new Domain();
    }

    /**
     * @dataProvider providerForDomain
     */
    public function testValidDomainsShouldReturnTrue($input, $tldcheck = true): void
    {
        $this->object->tldCheck($tldcheck);
        self::assertTrue($this->object->__invoke($input));
        self::assertTrue($this->object->assert($input));
        self::assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotDomain
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     */
    public function testNotDomain($input, $tldcheck = true): void
    {
        $this->object->tldCheck($tldcheck);
        self::assertFalse($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotDomain
     * @expectedException \Respect\Validation\Exceptions\DomainException
     */
    public function testNotDomainCheck($input, $tldcheck = true): void
    {
        $this->object->tldCheck($tldcheck);
        self::assertFalse($this->object->assert($input));
    }

    public function providerForDomain()
    {
        return [
            ['111111111111domain.local', false],
            ['111111111111.domain.local', false],
            ['example.com'],
            ['xn--bcher-kva.ch'],
            ['mail.xn--bcher-kva.ch'],
            ['example-hyphen.com'],
            ['example--valid.com'],
            ['std--a.com'],
            ['r--w.com'],
        ];
    }

    public function providerForNotDomain()
    {
        return [
            [null],
            [''],
            ['2222222domain.local'],
            ['-example-invalid.com'],
            ['example.invalid.-com'],
            ['xn--bcher--kva.ch'],
            ['example.invalid-.com'],
            ['1.2.3.256'],
            ['1.2.3.4'],
        ];
    }

    /**
     * @dataProvider providerForDomain
     */
    public function testBuilder($validDomain, $checkTLD = true): void
    {
        self::assertTrue(
            v::domain($checkTLD)->validate($validDomain),
            sprintf('Domain "%s" should be valid. (Check TLD: %s)', $validDomain, var_export($checkTLD, true))
        );
    }
}
