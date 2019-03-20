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

namespace Respect\Validation\Helpers\Data;

use PHPUnit\Framework\TestCase;

/**
 * @group helper
 *
 * @covers \Respect\Validation\Helpers\Data;
 *
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class DataTest extends TestCase
{
    /**
     * @var string
     */
    private $directory = __DIR__.'/dummyData';

    /**
     * @test
     */
    public function shouldCreateAnInstanceOfClassWhenUsingTheFactory(): void
    {
        $instance = Data::directory($this->directory);

        $this->assertInstanceOf(Data::class, $instance);
        $this->assertSame($instance->getDirectory(), $this->directory);
    }

    /**
     * @return mixed[][]
     */
    public function invalidFilesPorvider(): array
    {
        return [
            ['Invalid file name', '', DataException::NO_FILE_PROVIDED],
            ['Invalid file name 2', 123456, DataException::NO_FILE_PROVIDED],
            ['Inexistent file name', 'somefile.json', DataException::FILE_NOT_FOUND],
            ['Unsupported loader', 'test.php', DataException::LOADER_NOT_SUPPORTED],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function validFilesPorvider(): array
    {
        return [
            ['A JSON file', 'test.json'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function invalidDataValuesPorvider(): array
    {
        return [
            ['test.json', 'test'],
            ['test.json', 'foo.bar'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function validDataValuesPorvider(): array
    {
        return [
            ['A value with a simple path', 'test.json', ['country_name', 'Andorra']],
            ['A value with nested path', 'test.json', ['subdivisions.02', 'Canillo']],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function callbacksPorvider(): array
    {
        return [
            ['Reverse string', 'test.json', 'country_name', 'strrev', 'arrodnA'],
        ];
    }

    /**
     * @param mixed $input
     * @dataProvider invalidFilesPorvider
     * @test
     */
    public function testInvalidFiles(string $_, $input, int $expectedExceptionCode): void
    {
        $this->expectException(DataException::class);
        $this->expectExceptionCode($expectedExceptionCode);
        Data::directory($this->directory)->load($input);
    }

    /**
     * @dataProvider validFilesPorvider
     * @test
     */
    public function testValidFiles(string $_, string $input): void
    {
        Data::directory($this->directory)->load($input);

        // Assert that no expection is thrown
        $this->assertTrue(true);
    }

    /**
     * @dataProvider invalidDataValuesPorvider
     * @test
     */
    public function testinvalidDataValues(string $input, string $valuePath): void
    {
        $this->expectException(DataException::class);
        $this->expectExceptionCode(DataException::VALUE_NOT_FOUND);
        $data = Data::directory($this->directory);
        $data->load($input);
        $data->get($valuePath);
    }

    /**
     * @param mixed[] $expectedData
     * @dataProvider validDataValuesPorvider
     * @test
     */
    public function testvalidDataValues(string $_, string $input, array $expectedData): void
    {
        $data = Data::directory($this->directory);
        $data->load($input);
        $this->assertSame($data->get($expectedData[0]), $expectedData[1]);
    }

    /**
     * @dataProvider callbacksPorvider
     * @test
     */
    public function testCallback(string $_, string $i, string $v, string $callback, string $expectedOutput): void
    {
        $data = Data::directory($this->directory);
        $data->load($i);
        $this->assertSame($data->get($v, $callback), $expectedOutput);
    }
}
