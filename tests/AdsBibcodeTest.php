<?php
namespace Altmetric\Identifiers;

class AdsBibcodeTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsBibcodes()
    {
        $this->assertEquals(['1974AJ.....79..819H'], AdsBibcode::extract('This is a bibcode: 1974AJ.....79..819H'));
    }

    public function testExtractsPhdThesisBibcodes()
    {
        $this->assertEquals(['2004PhRvL..93o0801M'], AdsBibcode::extract('2004PhRvL..93o0801M'));
    }

    public function testDoesNotExtractBibcodesFromDois()
    {
        $this->assertEmpty(AdsBibcode::extract('10.1097/01.ASW.0000443266.17665.19'));
    }

    public function testExtractsBibcodesWithTrailingUnicodePunctuation()
    {
        $this->assertEquals(['2004PhRvL..93o0801M'], AdsBibcode::extract('2004PhRvL..93o0801M…'));
    }
}
