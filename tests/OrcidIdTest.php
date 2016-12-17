<?php
namespace Altmetric\Identifiers;

class OrcidIdTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsOrcids()
    {
        $this->assertEquals(['0000-0002-0088-0058', '0000-0002-0488-8591'], OrcidId::extract("orcid.org/0000-0002-0088-0058\n0000-0002-0488-8591"));
    }

    public function testDoesNotExtractInvalidIds()
    {
        $this->assertEmpty(OrcidId::extract('0000-0002-0088-0052'));
    }

    public function testSupportsOrcidsEndingInX()
    {
        $this->assertEquals(['0000-0002-1694-233X'], OrcidId::extract('http://orcid.org/0000-0002-1694-233X'));
    }

    public function testSupportsOrcidsEndingInLowercaseX()
    {
        $this->assertEquals(['0000-0002-1694-233X'], OrcidId::extract('0000-0002-1694-233x'));
    }
}
