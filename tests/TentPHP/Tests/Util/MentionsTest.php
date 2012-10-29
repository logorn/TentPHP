<?php

namespace TentPHP\Tests\Util;

use TentPHP\Util\Mentions;

class MentionsTest extends \PHPUnit_Framework_TestCase
{
    private $mentions;

    public function setUp()
    {
        $this->mentions = new Mentions();
    }

    public function testParseMultiple()
    {
        $data = $this->mentions->extractMentions("^beberlei ^lala", "https://beberlei.tent.is");

        $this->assertEquals(array(
            array("entity" => "https://beberlei.tent.is", "pos" => 0, "length" => 9),
            array("entity" => "https://lala.tent.is", "pos" => 10, "length" => 5)
        ), $data);
    }

    public function testParseAtTheBeginning()
    {
        $data = $this->mentions->extractMentions("^beberlei", "https://beberlei.tent.is");

        $this->assertEquals(array(array("entity" => "https://beberlei.tent.is", "pos" => 0, "length" => 9)), $data);
    }

    public function testParseFullIdentifer()
    {
        $data = $this->mentions->extractMentions("^https://foo.bar.is", "https://beberlei.tent.is");

        $this->assertEquals(array(array('entity' => 'https://foo.bar.is', 'pos' => 0, 'length' => 19)), $data);
    }
}

