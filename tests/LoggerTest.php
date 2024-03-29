<?php
/**
 * Created by PhpStorm.
 * User: edwin
 * Date: 07-05-18
 * Time: 21:10
 */

namespace test\edwrodrig\logger;

use edwrodrig\logger\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @var resource Store temp Logger output
     */
    private $target;


    public function setUp() : void {
        $this->target = fopen('php://memory', 'w+');
    }

    public function getTargetData() : string {
        rewind($this->target);
        return stream_get_contents($this->target);
    }

    public function tearDown() : void {
        fclose($this->target);
    }

    public function testBasic() {

        $logger = new Logger($this->target);
        $logger->log('Hola mundo');

        $this->assertEquals('Hola mundo', $this->getTargetData());
    }

    public function testCompletingDone() {

        $logger = new Logger($this->target);
        $logger->begin('Completing...');
        $logger->end("DONE");

        $this->assertEquals("Completing...DONE", $this->getTargetData());
    }

    public function testLogEmpty() {
        $logger = new Logger($this->target);
        $logger->begin('Completing...');
        $logger->log("");
        $logger->end("DONE");

        $this->assertEquals("Completing...DONE", $this->getTargetData());
    }

    public function testCase1() {
        $logger = new Logger($this->target);
        $logger->begin('[');
            $logger->begin('[');
            $logger->end("]");
            $logger->begin('[');
            $logger->end("]");
        $logger->end("]");
        $logger->begin('[');
        $logger->end("]");

        $this->assertEquals("[\n  []\n  []\n]\n[]", $this->getTargetData());
    }

    public function testCase2() {
        $logger = new Logger($this->target);
        $logger->begin('[');
        $logger->begin('[');
        $logger->end("]\n");
        $logger->begin('[');
        $logger->end("]\n");
        $logger->end("]\n");
        $logger->begin('[');
        $logger->end("]\n");

        $this->assertEquals("[\n  []\n  []\n]\n[]", $this->getTargetData());
    }


    public function testsDefaultTarget() {
        $logger = new Logger();
        $this->assertEquals(STDOUT, $logger->getDefaultTarget());
    }

}
