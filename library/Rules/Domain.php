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

use Respect\Validation\Exceptions\DomainException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mehmet Tolga Avcioglu <mehmet@activecom.net>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Róbert Nagy <vrnagy@gmail.com>
 */
class Domain extends AbstractComposite
{
    /**
     * @var Validatable
     */
    protected $tld;

    /**
     * @var Validatable[]
     */
    protected $checks = [];

    /**
     * @var AllOf
     *
     */
    protected $otherParts;

    public function __construct(bool $tldCheck = true)
    {
        $this->checks[] = new NoWhitespace();
        $this->checks[] = new Contains('.');
        $this->checks[] = new Length(3, null);
        $this->tldCheck($tldCheck);
        $this->otherParts = new AllOf(
            new Alnum('-'),
            new Not(new StartsWith('-')),
            new AnyOf(
                new Not(new Contains('--')),
                new Callback(static function ($str) {
                    return 1 == mb_substr_count($str, '--');
                })
            ),
            new Not(new EndsWith('-'))
        );

        parent::__construct();
    }

    public function tldCheck(bool $do = true): void
    {
        $this->tld = $do ? new Tld() : new AllOf(
            new Not(
                new StartsWith('-')
            ),
            new NoWhitespace(),
            new Length(2, null)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        foreach ($this->checks as $chk) {
            if (!$chk->validate($input)) {
                return false;
            }
        }

        $parts = explode('.', (string) $input);

        if (count($parts) < 2
            || !$this->tld->validate(array_pop($parts))) {
            return false;
        }

        foreach ($parts as $p) {
            if (!$this->otherParts->validate($p)) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        $exceptions = [];
        foreach ($this->checks as $chk) {
            $this->collectAssertException($exceptions, $chk, $input);
        }

        $parts = explode('.', (string) $input);
        if (count($parts) >= 2) {
            $this->collectAssertException($exceptions, $this->tld, array_pop($parts));
        }

        foreach ($parts as $p) {
            $this->collectAssertException($exceptions, $this->otherParts, $p);
        }

        if (count($exceptions)) {
            /** @var DomainException $domainException */
            $domainException = $this->reportError($input);
            $domainException->addChildren($exceptions);

            throw $domainException;
        }
    }

    /**
     * @param ValidationException[] $exceptions
     * @param mixed $input
     */
    protected function collectAssertException(array &$exceptions, Validatable $validator, $input): void
    {
        try {
            $validator->assert($input);
        } catch (ValidationException $e) {
            $exceptions[] = $e;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function check($input): void
    {
        foreach ($this->checks as $chk) {
            $chk->check($input);
        }

        $parts = explode('.', $input);
        if (count($parts) >= 2) {
            $this->tld->check(array_pop($parts));
        }

        foreach ($parts as $p) {
            $this->otherParts->check($p);
        }
    }
}
