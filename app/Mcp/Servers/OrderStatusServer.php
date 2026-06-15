<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\OrderStatusFinderTool;
use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;

#[Name('Order Status Server')]
#[Version('0.0.1')]
#[Instructions('To fetch Order Status using order id')]
class OrderStatusServer extends Server
{
    protected array $tools = [OrderStatusFinderTool::class];
    protected array $resources = [];
    protected array $prompts = [];
}
