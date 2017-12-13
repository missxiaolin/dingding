<?php
// +----------------------------------------------------------------------
// | bootstrap.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 xiaolin All rights reserved.
// +----------------------------------------------------------------------
// | Author: xiaolin <462441355@qq.com> <https://github.com/missxiaolin>
// +----------------------------------------------------------------------

namespace Xiao\DingTalk\ServiceProviders;

use Xiao\DingTalk\Robot\RobotFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class RobotServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['robot'] = function ($pimple) {
            $config = $pimple['config'];
            return new RobotFactory($config);
        };
    }
}