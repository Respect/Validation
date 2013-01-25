<?php
namespace Respect\Validation\Rules;

class DirectoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidDirectory
     */
    public function testValidDirectoryShouldReturnTrue($input)
    {
        $rule = new Directory();
        $this->assertTrue($rule->__invoke($input));
        $this->assertTrue($rule->assert($input));
        $this->assertTrue($rule->check($input));
    }

    /**
     * @dataProvider providerForInvalidDirectory
     * @expectedException Respect\Validation\Exceptions\DirectoryException
     */
    public function testInvalidDirectoryShouldThrowException($input)
    {
        $rule = new Directory();
        $this->assertFalse($rule->__invoke($input));
        $this->assertFalse($rule->assert($input));
        $this->assertFalse($rule->check($input));
    }

    /**
     * @dataProvider providerForDirectoryObjects
     */
    public function testDirectoryWithObjects($object, $valid)
    {
        $rule = new Directory();
        $this->assertEquals($valid, $rule->validate($object));
    }

    public function providerForDirectoryObjects()
    {
        return array(
            array(new \SplFileInfo(__DIR__), true),
            array(new \SplFileInfo(__FILE__), false),
            /**
             * PHP 5.4 does not allows to use SplFileObject with directories.
             * array(new \SplFileObject(__DIR__), true),
             */
            array(new \SplFileObject(__FILE__), false),
        );
    }

    public function providerForValidDirectory()
    {
        $directories = array(
            sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dataprovider-1',
            sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dataprovider-2',
            sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dataprovider-3',
            sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dataprovider-4',
            sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dataprovider-5',
        );

        return array(array('')) + array_map(
            function ($directory) {
                if (!is_dir($directory)) {
                    mkdir($directory, 0766, true);
                }

                return array(realpath($directory));
            },
            $directories
        );
    }

    public function providerForInvalidDirectory()
    {
        return array_chunk(
            array(
                __FILE__,
                __DIR__ . '/../../../../../README.md',
                __DIR__ . '/../../../../../composer.json',
                new \stdClass(),
                array(__DIR__),
            ),
            1
        );
    }
}

