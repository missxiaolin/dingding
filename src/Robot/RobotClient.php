<?php
// +----------------------------------------------------------------------
// | bootstrap.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 xiaolin All rights reserved.
// +----------------------------------------------------------------------
// | Author: xiaolin <462441355@qq.com> <https://github.com/missxiaolin>
// +----------------------------------------------------------------------
namespace Xiao\DingTalk\Robot;

use Xiao\DingTalk\Application;

class RobotClient
{
    public $url;

    public function __construct(array $config)
    {
        $this->url = $config['url'];
    }

    /**
     * @desc   发送钉钉消息
     * @author limx
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($data = [])
    {
        $app = Application::getInstance();
        return $app->httpClient->post($this->url, [
            'json' => $data,
        ]);
    }

    /**
     * @desc   发送Text类型数据
     * @author limx
     * @param string $content
     * @param array  $at
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendText(string $content, array $at = [])
    {
        $data = [
            'msgtype' => 'text',
            'text' => [
                'content' => $content,
            ],
            'at' => $at,
        ];

        return $this->send($data);
    }

    /**
     * @desc   发送link类型数据
     * @author limx
     * @param array $link
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendLink(array $link = [])
    {
        $data = [
            'msgtype' => 'link',
            'link' => [
                'text' => $link['text'],
                'title' => $link['title'],
                'picUrl' => $link['picUrl'],
                'messageUrl' => $link['messageUrl'],
            ],
        ];

        return $this->send($data);
    }

    /**
     * @desc   发送Markdown消息
     * @author limx
     * @param string $title
     * @param string $text
     * @param array  $at
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendMarkdown(string $title, string $text, array $at = [])
    {
        $data = [
            'msgtype' => 'markdown',
            'markdown' => [
                'text' => $text,
                'title' => $title,
            ],
            'at' => $at
        ];

        return $this->send($data);
    }
}