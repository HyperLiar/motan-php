<?php
namespace Motan;
define('DEFAULT_GROUP', 'motan-demo-rpc');
define('DEFAULT_SERVICE', 'com.weibo.HelloMTService');
define('DEFAULT_PROTOCOL', 'motan2');

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-01-09 at 00:43:02.
 */
class MClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var MClient
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $app_name = 'phpt-test-MClient';
        $group = DEFAULT_GROUP;
        $service = DEFAULT_SERVICE;
        $protocol = DEFAULT_PROTOCOL;
        $this->object = new MClient( $app_name, $group, $service, $protocol );;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Motan\MClient::doMultiCall
     * @todo   Implement testDoMultiCall().
     */
    public function testDoMultiCall()
    {
        $req1 = new \Motan\Request(DEFAULT_SERVICE, 'Hello', ['a' => 'b']);
        $req2 = new \Motan\Request(DEFAULT_SERVICE, 'Hello', ['xx' => 'wwww']);
        $req3 = new \Motan\Request(DEFAULT_SERVICE, 'HelloX', ['string', 123,124,['string','arr']]);
        $rs = $this->object->doMultiCall([
            $req1, $req2, $req3
        ]);
        $this->assertEquals($this->object->getMRs($req1), "[]-------[128 1 2 128 1 2]");

        $rs_empty = $this->object->doMultiCall([]);
        $this->assertEquals($rs_empty, []);
    }

    /**
     * @covers Motan\MClient::getMRs
     * @todo   Implement testGetMRs().
     */
    public function testGetMRs()
    {
        $req1 = new \Motan\Request(DEFAULT_SERVICE, 'Hello', ['a' => 'b']);
        $req2 = new \Motan\Request(DEFAULT_SERVICE, 'Hello', ['xx' => 'wwww']);
        $req3 = new \Motan\Request(DEFAULT_SERVICE, 'HelloX', [33, 123,124,['string','arr']]);
        $this->object->doMultiCall([
            $req1, $req2, $req3
        ]);
        $rs = $this->object->getMRs($req1);
        $this->assertEquals($rs, "[]-------[128 1 2 128 1 2]");
    }

    /**
     * @covers Motan\MClient::getMException
     * @todo   Implement testGetMException().
     */
    public function testGetMException()
    {
        $req1 = new \Motan\Request(DEFAULT_SERVICE, 'Hello', ['a' => 'b']);
        $req2 = new \Motan\Request(DEFAULT_SERVICE, 'Hello', ['xx' => 'wwww']);
        $req3 = new \Motan\Request(DEFAULT_SERVICE, 'HelloX', [33, 123,124,['string','arr']]);
        $this->object->doMultiCall([
            $req1, $req2, $req3
        ]);
        $rs = $this->object->getMException($req3);
        $this->assertEquals($rs, '{"errcode":500,"errmsg":"provider call panic","errtype":1}');
    }
}
