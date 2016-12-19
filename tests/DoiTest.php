<?php
namespace Altmetric\Identifiers;

class DoiTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsDois()
    {
        $this->assertEquals(['10.1049/el.2013.3006'], Doi::extract('This is an example of DOI: 10.1049/el.2013.3006'));
    }

    public function testLowercasesDois()
    {
        $this->assertEquals(['10.1097/01.asw.0000443266.17665.19'], Doi::extract('10.1097/01.ASW.0000443266.17665.19'));
    }
}
