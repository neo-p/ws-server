<?php

namespace NeoP\WebSocket\Server\Events;

use Swoole\Server;
use Swoole\Websocket\Frame;
use NeoP\Server\Annotation\Mapping\SwooleEvent;
use NeoP\WebSocket\Server\Events\EventType;

class OnMessageEvent
{
    public function handler(Server $server, Frame $frame)
    {
        var_dump("__ON_MESSAGE__, workerId: " . $server->worker_id);
    }
}
