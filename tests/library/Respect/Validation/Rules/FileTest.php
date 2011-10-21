<?php

namespace Respect\Validation\Rules;

class FileTest extends \PHPUnit_Framework_TestCase
{

    protected $file;
    
    protected function setUp()
    {
        $this->file = new File;
    }
    
    /**
     * @dataProvider providerForFile
     * @expectedException Respect\Validation\Exceptions\FileException
     */
    public function test_invalid_file($input)
    {
        $this->assertTrue($this->file->Validate($input));
    }
    
    /**
     * @dataProvider providerForFile
     * @expectedException Respect\Validation\Exceptions\FileException
     */
    public function test_valid_file($input)
    {
        $this->assertTrue($this->file->Validate($input));
    } 
}
