<?php

namespace NeoP\WebSocket\Server\Events;

use Swoole\Server;
use Swoole\Websocket\Frame;
use NeoP\Server\Annotation\Mapping\SwooleEvent;
use NeoP\WebSocket\Server\Events\EventType;

/**
 * @SwooleEvent(EventType::ON_MESSAGE, type=EventType::LISTEN_WEBSOCKET)
 */
class OnMessageEvent
{
    public function handler(Server $server, Frame $frame)
    {
        // var_dump("__ON_MESSAGE__, workerId: " . $server->worker_id);
    }
}
