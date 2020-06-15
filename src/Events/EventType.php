<?php

namespace NeoP\WebSocket\Server\Events;

use NeoP\Server\Events\EventType as ServerEventType;

class EventType extends ServerEventType
{
    const ON_REQUEST = "request";
    const ON_OPEN = "open";
    const ON_MESSAGE = "message";
    const LISTEN_WEBSOCKET = 3;
}
