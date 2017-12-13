<?php
// +----------------------------------------------------------------------
// | bootstrap.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 xiaolin All rights reserved.
// +----------------------------------------------------------------------
// | Author: xiaolin <462441355@qq.com> <https://github.com/missxiaolin>
// +----------------------------------------------------------------------
namespace Tests;

use PHPUnit\Framework\TestCase as UnitTestCase;
use Xiao\DingTalk\Application;

class TestCase extends UnitTestCase
{
    /** @var Application */
    public $ding;

    public $config = 1;

    public function setUp()
    {
//        $url = file_get_contents('url');

        $token = '09fc591d1e369e228de645e59385b981081088fc5f20f0ed91510753c74981e0';
        $url = 'https://oapi.dingtalk.com/robot/send?access_token=' . $token;

        $this->config = [
            // HTTP 请求的超时时间（秒）
            'timeout' => 5.0,
            // 机器人模块
            'robot' => [
                'gateways' => [
                    'test' => [
                        'url' => $url,
                    ],
                    'test2' => [
                        'url' => $url,
                    ],
                ],
            ],
        ];

        $this->ding = new Application($this->config);
    }
}