<?php
namespace Altmetric\Identifiers;

class HandleTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsHandles()
    {
        $this->assertEquals(['10149/596901'], Handle::extract('http://hdl.handle.net/10149/596901'));
    }
}
