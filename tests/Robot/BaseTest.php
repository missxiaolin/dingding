<?php
// +----------------------------------------------------------------------
// | bootstrap.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 xiaolin All rights reserved.
// +----------------------------------------------------------------------
// | Author: xiaolin <462441355@qq.com> <https://github.com/missxiaolin>
// +----------------------------------------------------------------------
namespace Tests\Robot;

use limx\Support\Collection;
use Tests\TestCase;
use Xiao\DingTalk\Application;
use Xiao\DingTalk\Robot\RobotClient;

class BaseTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals($this->ding, Application::getInstance());
    }

    public function testConfig()
    {
        $config = new Collection($this->config);
        $this->assertEquals($config->toArray(), $this->ding->config->toArray());
    }

    public function testSet()
    {
        $token = '09fc591d1e369e228de645e59385b981081088fc5f20f0ed91510753c74981e0';
        $url = 'https://oapi.dingtalk.com/robot/send?access_token=' . $token;

        $set = new RobotClient([
            'url' => $url
        ]);

        $this->ding->setTest = $set;

        $this->assertEquals($set, $this->ding->setTest);

        /** @var \Psr\Http\Message\ResponseInterface $res */
        $res = $this->ding->setTest->sendText('Hello World');
        $result = $res->getBody()->getContents();
        $this->assertEquals(
            [
                'errcode' => 0,
                'errmsg' => 'ok'
            ],
            json_decode($result, true)
        );
    }
}
