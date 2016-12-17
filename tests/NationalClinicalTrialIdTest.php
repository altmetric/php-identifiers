<?php
namespace Altmetric\Identifiers;

class NationalClinicalTrialIdTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsNctIds()
    {
        $this->assertEquals(['NCT00000106', 'NCT00000107'], NationalClinicalTrialId::extract("NCT00000106\nNCT00000107"));
    }

    public function testReturnsEmptyArrayForNoMatches()
    {
        $this->assertEmpty(NationalClinicalTrialId::extract('foobar'));
    }

    public function testNormalizesNctIds()
    {
        $this->assertEquals(['NCT00000106', 'NCT00000107'], NationalClinicalTrialId::extract("nct00000106\nnCt00000107"));
    }
}
