<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Factory;
use Respect\Validation\Validators\Length;
use Respect\Validation\Validators\Phone;

use function sprintf;

#[CoversClass(TemplateRegistry::class)]
final class TemplateRegistryTest extends TestCase
{
    private TemplateRegistry $instance;

    protected function setUp(): void
    {
        parent::setUp();

        $this->instance = new TemplateRegistry();
    }

    #[Test]
    public function itShouldReturnInstanceWhenDefaultTemplateExists(): void
    {
        $template = $this->instance->get(Length::class);

        self::assertSame('The length of', $template->default);
        self::assertSame(Validator::TEMPLATE_STANDARD, $template->id);
    }

    #[Test]
    public function itShouldReturnInstanceForSpecificTemplateId(): void
    {
        $template = $this->instance->get(Phone::class, Phone::TEMPLATE_FOR_COUNTRY);

        self::assertSame(
            '{{subject}} must be a phone number for country {{countryName|trans}}',
            $template->default,
        );
        self::assertSame(Phone::TEMPLATE_FOR_COUNTRY, $template->id);
    }

    #[Test]
    public function itShouldThrowWhenTemplatesAreFound(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Template with id "%s" not found in validator "%s".',
                Validator::TEMPLATE_STANDARD,
                Factory::class,
            ),
        );

        $this->instance->get(Factory::class);
    }

    #[Test]
    public function itShouldThrowWhenTemplateIdNotFound(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Template with id "%s" not found in validator "%s".',
                'non-existent',
                Length::class,
            ),
        );

        $this->instance->get(Length::class, 'non-existent');
    }
}
