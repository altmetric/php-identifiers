<?php
namespace Altmetric\Identifiers;

class RepecIdTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsRepecIds()
    {
        $this->assertEquals(
            ['RePEc:wbk:wbpubs:2266', 'RePEc:inn:wpaper:2016-03'],
            RepecId::extract("RePEc:wbk:wbpubs:2266\nRePEc:inn:wpaper:2016-03")
        );
    }

    public function testNormalizesRepecIds()
    {
        $this->assertEquals(
            ['RePEc:wbk:wbpubs:2266', 'RePEc:inn:wpaper:2016-03'],
            RepecId::extract("REPEC:wbk:wbpubs:2266\nrepec:inn:wpaper:2016-03")
        );
    }

    public function testExtractsRepecIdsEndingInUnicodeWhitespace()
    {
        $this->assertEquals(['RePEc:wbk:wbpubs:2266'], RepecId::extract('RePEc:wbk:wbpubs:2266 '));
    }
}
