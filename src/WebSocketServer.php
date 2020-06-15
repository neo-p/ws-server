<?php declare(strict_types=1);

namespace NeoP\WebSocket\Server;

use Swoole\WebSocket\Server as SwooleServer;
use Swoole\Process;
use NeoP\WebSocket\Server\Events\RequestEvent;
use NeoP\DI\Annotation\Mapping\Depend;
use NeoP\Server\Contract\ServiceInerface;
use NeoP\Server\Listener\SwooleListener;
use NeoP\WebSocket\Server\Events\EventType;
use NeoP\Log\Log;
use ReflectionMethod;

/**
 * @Depend()
 * @var WebSocketServer
 */
class WebSocketServer implements ServiceInerface
{
    protected $server;
    protected $host;
    protected $port;
    protected $mode;
    protected $setting;
    protected $options;

    public function beforeStart()
    {
        Log::stdout("WebSocket Server starting...", 0, Log::MODE_DEFAULT, Log::FG_WHITE);
        Log::stdout("---| HOST: " . $this->host . " | PORT: " . $this->port . " |--- ", 0, Log::MODE_DEFAULT);
    }

    public function init(string $host, int $port, int $mode, array $setting): void
    {

        $this->host = $host;
        $this->port = $port;
        $this->mode = $mode;
        $this->setting = $setting;
        $this->options = service('server.options', []);
        $this->server = new SwooleServer($host, $port, $mode);
        $this->server->set($setting);
    } 

    public function on(string $event, callable $callback): void
    {
        $this->server->on($event, $callback);
    }
    
    public function registerEvent(): void
    {
        if (SwooleListener::hasListens(EventType::LISTEN_WEBSOCKET)) {
            foreach (SwooleListener::getListens(EventType::LISTEN_WEBSOCKET) as $event => $callback) {
                $this->server->on($event, $callback);
            }
        }
    }
    
    public function start(): void
    {
        $this->beforeStart();
        $this->server->start();
    }
    
    public function reload(): void
    {
        $this->server->reload();
    }
    
    public function addProcess(Process $process): int
    {
        return $this->server->addProcess($process);
    }

    public function getServer(): Server
    {
        return $this->server;
    }
    
}
