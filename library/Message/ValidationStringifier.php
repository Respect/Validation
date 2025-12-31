<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use DateTimeInterface;
use Respect\Stringifier\Quoter;
use Respect\Stringifier\Stringifier;
use Respect\Stringifier\Stringifiers\ArrayObjectStringifier;
use Respect\Stringifier\Stringifiers\ArrayStringifier;
use Respect\Stringifier\Stringifiers\BoolStringifier;
use Respect\Stringifier\Stringifiers\CompositeStringifier;
use Respect\Stringifier\Stringifiers\DateTimeStringifier;
use Respect\Stringifier\Stringifiers\DeclaredStringifier;
use Respect\Stringifier\Stringifiers\EnumerationStringifier;
use Respect\Stringifier\Stringifiers\InfiniteNumberStringifier;
use Respect\Stringifier\Stringifiers\IteratorObjectStringifier;
use Respect\Stringifier\Stringifiers\JsonEncodableStringifier;
use Respect\Stringifier\Stringifiers\JsonSerializableObjectStringifier;
use Respect\Stringifier\Stringifiers\NotANumberStringifier;
use Respect\Stringifier\Stringifiers\NullStringifier;
use Respect\Stringifier\Stringifiers\ObjectStringifier;
use Respect\Stringifier\Stringifiers\ObjectWithDebugInfoStringifier;
use Respect\Stringifier\Stringifiers\ResourceStringifier;
use Respect\Stringifier\Stringifiers\StringableObjectStringifier;
use Respect\Stringifier\Stringifiers\ThrowableObjectStringifier;
use Respect\Validation\Message\Stringifier\ListedStringifier;
use Respect\Validation\Message\Stringifier\NameStringifier;
use Respect\Validation\Message\Stringifier\PathStringifier;
use Respect\Validation\Message\Stringifier\QuotedStringifier;
use Respect\Validation\Message\Stringifier\SubjectStringifier;

final readonly class ValidationStringifier implements Stringifier
{
    public const int MAXIMUM_LENGTH = 120;
    private const int MAXIMUM_DEPTH = 3;
    private const int MAXIMUM_NUMBER_OF_ITEMS = 5;
    private const int MAXIMUM_NUMBER_OF_PROPERTIES = self::MAXIMUM_NUMBER_OF_ITEMS;

    private Stringifier $stringifier;

    public function __construct(
        private Quoter $quoter,
    ) {
        $this->stringifier = $this->createStringifier($quoter);
    }

    public function stringify(mixed $raw, int $depth): string
    {
        return $this->stringifier->stringify($raw, $depth) ?? $this->quoter->quote('unknown', $depth);
    }

    private function createStringifier(Quoter $quoter): Stringifier
    {
        $jsonEncodableStringifier = new JsonEncodableStringifier();

        $stringifier = new CompositeStringifier(
            new InfiniteNumberStringifier($quoter),
            new NotANumberStringifier($quoter),
            new ResourceStringifier($quoter),
            new BoolStringifier($quoter),
            new NullStringifier($quoter),
            new DeclaredStringifier($quoter),
            $jsonEncodableStringifier,
        );
        $arrayStringifier = new ArrayStringifier(
            $stringifier,
            $quoter,
            self::MAXIMUM_DEPTH,
            self::MAXIMUM_NUMBER_OF_ITEMS,
        );
        $stringifier->prependStringifier($arrayStringifier);
        $stringifier->prependStringifier(new ObjectStringifier(
            $stringifier,
            $quoter,
            self::MAXIMUM_DEPTH,
            self::MAXIMUM_NUMBER_OF_PROPERTIES,
        ));
        $stringifier->prependStringifier(new EnumerationStringifier($quoter));
        $stringifier->prependStringifier(new ObjectWithDebugInfoStringifier($arrayStringifier, $quoter));
        $stringifier->prependStringifier(new ArrayObjectStringifier($arrayStringifier, $quoter));
        $stringifier->prependStringifier(new JsonSerializableObjectStringifier($jsonEncodableStringifier, $quoter));
        $stringifier->prependStringifier(new StringableObjectStringifier($jsonEncodableStringifier, $quoter));
        $stringifier->prependStringifier(new ThrowableObjectStringifier($jsonEncodableStringifier, $quoter));
        $stringifier->prependStringifier(new DateTimeStringifier($quoter, DateTimeInterface::ATOM));
        $stringifier->prependStringifier(new IteratorObjectStringifier($stringifier, $quoter));

        // Stringifiers from this project only
        $stringifier->prependStringifier(new PathStringifier($quoter));
        $stringifier->prependStringifier(new QuotedStringifier($quoter));
        $stringifier->prependStringifier(new ListedStringifier($stringifier));
        $stringifier->prependStringifier(new NameStringifier());
        $stringifier->prependStringifier(new SubjectStringifier($stringifier));

        return $stringifier;
    }
}
