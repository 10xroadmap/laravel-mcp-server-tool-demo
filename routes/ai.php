<?php

use App\Mcp\Servers\OrderStatusServer;
use Laravel\Mcp\Facades\Mcp;

// Mcp::web('/mcp/demo', \App\Mcp\Servers\PublicServer::class);
Mcp::web('/mcp/order-status', OrderStatusServer::class);
