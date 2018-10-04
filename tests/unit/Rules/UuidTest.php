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
use Respect\Validation\Test\RuleTestCase;

/**
 * This class provides tests for the UUID validation.
 *
 * @group  rule
 * @covers \Respect\Validation\Rules\Uuid
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Weimann <mail@michael-weimann.eu>
 */
class UuidTest extends RuleTestCase
{
    /**
     * Provides valid Uuid version params.
     *
     * @return array
     */
    public function provideValidUuidConstructorParams(): array
    {
        return [
            [Uuid::VERSION_ALL],
            [Uuid::VERSION_1],
            [Uuid::VERSION_2],
            [Uuid::VERSION_3],
            [Uuid::VERSION_4],
            [Uuid::VERSION_5],
        ];
    }

    /**
     * Tests that the Uuid validation can be instantiated with correct params.
     *
     * @test
     * @dataProvider provideValidUuidConstructorParams
     *
     * @param mixed $version The version passed to the constructor
     */
    public function instantiate($version): void
    {
        self::expectNotToPerformAssertions();
        new Uuid($version);
    }

    /**
     * Provides invalid Uuid version params.
     *
     * @return array
     */
    public function provideInvalidUuidConstructorParams(): array
    {
        return [
            '0' => ['0'],
            '7' => ['7'],
            'a' => ['a'],
        ];
    }

    /**
     * Tests that Uuid cannot be instantiated with invalid constructor params.
     *
     * @test
     * @dataProvider provideInvalidUuidConstructorParams
     *
     * @param mixed $version The version passed to the constructor
     */
    public function instantiationError($version): void
    {
        $expectedMessage = sprintf('invalid version %s given, possible: [1-5], 1, 2, 3, 4, 5', $version);
        self::expectException(ComponentException::class);
        self::expectExceptionMessage($expectedMessage);
        new Uuid($version);
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $uuidRule = new Uuid();
        $uuidVersionAllRule = new Uuid(Uuid::VERSION_ALL);
        $uuidVersion1Rule = new Uuid(Uuid::VERSION_1);
        $uuidVersion2Rule = new Uuid(Uuid::VERSION_2);
        $uuidVersion3Rule = new Uuid(Uuid::VERSION_3);
        $uuidVersion4Rule = new Uuid(Uuid::VERSION_4);
        $uuidVersion5Rule = new Uuid(Uuid::VERSION_5);

        return [
            // Version 1
            [$uuidRule, 'a71a18f4-3a13-11e7-a919-92ebcb67fe33'],
            [$uuidRule, 'afa0eb06-3a13-11e7-a919-92ebcb67fe33'],
            [$uuidRule, 'b46e09d4-3a13-11e7-a919-92ebcb67fe33'],
            // Version 4
            [$uuidRule, '541b0e81-7afe-4fc4-a5f7-c01e9150df00'],
            [$uuidRule, '2481103e-2cd1-4c7a-b4c9-19defde3dd94'],
            [$uuidRule, '74077441-ea55-478a-a6f2-7dcd92239645'],
            // All versions validation
            [$uuidVersionAllRule, '4f75668d-78c3-1986-bcc1-a4a235a4b843'],
            [$uuidVersionAllRule, 'a71a18f4-3a13-21e7-a919-92ebcb67fe33'],
            [$uuidVersionAllRule, 'd36045b8-fe09-35f6-81a7-170e4e470964'],
            [$uuidVersionAllRule, '84cd4e68-015b-42fb-be57-ec3ef014328f'],
            [$uuidVersionAllRule, '541b0e81-7afe-5fc4-a5f7-c01e9150df00'],
            // Version 1 validation
            [$uuidVersion1Rule, 'a71a18f4-3a13-11e7-a919-92ebcb67fe33'],
            [$uuidVersion1Rule, 'afa0eb06-3a13-11e7-a919-92ebcb67fe33'],
            [$uuidVersion1Rule, 'b46e09d4-3a13-11e7-a919-92ebcb67fe33'],
            // Version 2 validation
            [$uuidVersion2Rule, 'e0b5ffb9-9caf-2a34-9673-8fc91db78be6'],
            [$uuidVersion2Rule, '3c8d84d3-4e00-2cc2-8036-d7dc167f9874'],
            [$uuidVersion2Rule, 'fb3a7909-8034-29f5-8f38-21adbc168db7'],
            // Version 3 validation
            [$uuidVersion3Rule, 'e0b5ffb9-9caf-3a34-9673-8fc91db78be6'],
            [$uuidVersion3Rule, '3c8d84d3-4e00-3cc2-8036-d7dc167f9874'],
            [$uuidVersion3Rule, 'fb3a7909-8034-39f5-8f38-21adbc168db7'],
            // Version 4 validation
            [$uuidVersion4Rule, 'e0b5ffb9-9caf-4a34-9673-8fc91db78be6'],
            [$uuidVersion4Rule, '3c8d84d3-4e00-4cc2-8036-d7dc167f9874'],
            [$uuidVersion4Rule, 'fb3a7909-8034-49f5-8f38-21adbc168db7'],
            // Version 5 validation
            [$uuidVersion5Rule, 'e0b5ffb9-9caf-5a34-9673-8fc91db78be6'],
            [$uuidVersion5Rule, '3c8d84d3-4e00-5cc2-8036-d7dc167f9874'],
            [$uuidVersion5Rule, 'fb3a7909-8034-59f5-8f38-21adbc168db7'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $uuidRule = new Uuid();
        $uuidVersionAllRule = new Uuid(Uuid::VERSION_ALL);
        $uuidVersion1Rule = new Uuid(Uuid::VERSION_1);
        $uuidVersion2Rule = new Uuid(Uuid::VERSION_2);
        $uuidVersion3Rule = new Uuid(Uuid::VERSION_3);
        $uuidVersion4Rule = new Uuid(Uuid::VERSION_4);
        $uuidVersion5Rule = new Uuid(Uuid::VERSION_5);

        return [
            // Nil/Empty UUID
            [$uuidRule, '00000000-0000-0000-0000-000000000000'],
            [$uuidVersionAllRule, '00000000-0000-0000-0000-000000000000'],
            [$uuidVersion1Rule, '00000000-0000-0000-0000-000000000000'],
            [$uuidVersion2Rule, '00000000-0000-0000-0000-000000000000'],
            [$uuidVersion3Rule, '00000000-0000-0000-0000-000000000000'],
            [$uuidVersion4Rule, '00000000-0000-0000-0000-000000000000'],
            [$uuidVersion5Rule, '00000000-0000-0000-0000-000000000000'],
            // Text
            [$uuidRule, 'Not an UUID'],
            [$uuidVersionAllRule, 'Not an UUID'],
            [$uuidVersion1Rule, 'Not an UUID'],
            [$uuidVersion2Rule, 'Not an UUID'],
            [$uuidVersion3Rule, 'Not an UUID'],
            [$uuidVersion4Rule, 'Not an UUID'],
            [$uuidVersion5Rule, 'Not an UUID'],
            // Invalid UUID's
            [$uuidRule, 'g71a18f4-3a13-11e7-a919-92ebcb67fe33'],
            [$uuidRule, 'a71a18f4-3g13-11e7-a919-92ebcb67fe33'],
            [$uuidRule, 'a71a18f4-3a13-11g7-a919-92ebcb67fe33'],
            [$uuidRule, 'a71a18f4-3a13-11e7-g919-92ebcb67fe33'],
            [$uuidRule, 'a71a18f4-3a13-11e7-a919-92gbcb67fe33'],
            [$uuidVersionAllRule, 'a71a18f4-3a13-11e7-a919-92gbcb67fe33'],
            [$uuidVersion1Rule, 'a71a18f4-3a13-11e7-a919-92gbcb67fe33'],
            [$uuidVersion2Rule, 'a71a18f4-3a13-11e7-a919-92gbcb67fe33'],
            [$uuidVersion3Rule, 'a71a18f4-3a13-11e7-a919-92gbcb67fe33'],
            [$uuidVersion4Rule, 'a71a18f4-3a13-11e7-a919-92gbcb67fe33'],
            [$uuidVersion5Rule, 'a71a18f4-3a13-11e7-a919-92gbcb67fe33'],
            // Invalid variant
            [$uuidRule, '96e37027-1247-4d9a-c5b5-74b6ba0b9e24'],
            [$uuidVersionAllRule, '96e37027-1247-4d9a-c5b5-74b6ba0b9e24'],
            [$uuidVersion1Rule, '96e37027-1247-4d9a-c5b5-74b6ba0b9e24'],
            [$uuidVersion2Rule, '96e37027-1247-4d9a-c5b5-74b6ba0b9e24'],
            [$uuidVersion3Rule, '96e37027-1247-4d9a-c5b5-74b6ba0b9e24'],
            [$uuidVersion4Rule, '96e37027-1247-4d9a-c5b5-74b6ba0b9e24'],
            [$uuidVersion5Rule, '96e37027-1247-4d9a-c5b5-74b6ba0b9e24'],
        ];
    }
}
