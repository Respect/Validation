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

use Respect\Validation\Test\TestCase;
use Respect\Validation\Validator as v;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\DomainException
 * @covers \Respect\Validation\Rules\Domain
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mehmet Tolga Avcioglu <mehmet@activecom.net>
 */
final class DomainTest extends TestCase
{
    /**
     * @var Domain
     */
    protected $object;

    protected function setUp(): void
    {
        $this->object = new Domain();
    }

    /**
     * @dataProvider providerForDomain
     *
     * @test
     *
     * @param mixed $input
     */
    public function validDomainsShouldReturnTrue($input, bool $tldcheck = true): void
    {
        $this->object->tldCheck($tldcheck);
        self::assertTrue($this->object->__invoke($input));
        $this->object->assert($input);
        $this->object->check($input);
    }

    /**
     * @dataProvider providerForNotDomain
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     *
     * @test
     *
     * @param mixed $input
     */
    public function notDomain($input, bool $tldcheck = true): void
    {
        $this->object->tldCheck($tldcheck);
        $this->object->check($input);
    }

    /**
     * @dataProvider providerForNotDomain
     * @expectedException \Respect\Validation\Exceptions\DomainException
     *
     * @test
     *
     * @param mixed $input
     */
    public function notDomainCheck($input, bool $tldcheck = true): void
    {
        $this->object->tldCheck($tldcheck);
        $this->object->assert($input);
    }

    /**
     * @return mixed[][]
     */
    public function providerForDomain(): array
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

    /**
     * @return mixed[][]
     */
    public function providerForNotDomain(): array
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
     *
     * @test
     */
    public function builder(string $validDomain, bool $checkTLD = true): void
    {
        self::assertTrue(
            v::domain($checkTLD)->validate($validDomain),
            sprintf('Domain "%s" should be valid. (Check TLD: %s)', $validDomain, var_export($checkTLD, true))
        );
    }
}
