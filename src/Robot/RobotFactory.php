<?php
// +----------------------------------------------------------------------
// | bootstrap.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 xiaolin All rights reserved.
// +----------------------------------------------------------------------
// | Author: xiaolin <462441355@qq.com> <https://github.com/missxiaolin>
// +----------------------------------------------------------------------
namespace Xiao\DingTalk\Robot;

use Xiao\DingTalk\Config;
use Xiao\DingTalk\Exceptions\DingTalkException;

class RobotFactory implements \ArrayAccess
{
    /** @var RobotClient[] $gateways */
    public $gateways;

    public function __construct(Config $config)
    {
        foreach ($config->robot['gateways'] as $key => $gateway) {
            $this->gateways[$key] = new RobotClient($gateway);
        }
    }

    public function __call($name, $arguments)
    {
        $gws = array_pop($arguments);

        $result = [];

        foreach ($gws as $key) {

            if (isset($this->gateways[$key])) {
                $result[$key] = $this->gateways[$key]->$name(...$arguments);
            }
        }

        return $result;
    }

    public function offsetExists($offset)
    {
        return isset($this->gateways[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->gateways[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ($value instanceof RobotClient) {
            $this->gateways[$offset] = $value;
        } else {
            throw new DingTalkException('The value must instanceof \Xiao\DingTalk\Robot\RobotClient');
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->gateways[$offset]);
    }
}