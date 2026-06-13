### Step 1 : Create a Laravel Project in an Empty Directory
```
composer create-project laravel/laravel .
```
### Step 2 : Setup Database in `.env` file. We have used MySQL
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mcp-db
DB_USERNAME=root
DB_PASSWORD='Password'
```
### Step 3 : Add MCP
```
composer require laravel/mcp
```

### Step 4 : Publish the AI SDK configuration
```
php artisan vendor:publish --tag=ai-routes
```
### Step 5 : Run Migration
```
php artisan migrate
```
### Step 6 : Set GEMIN key, or what ever provider
```
GEMINI_API_KEY=A(QE)W*OEWE(E&RWE)
ANTHROPIC_API_KEY=
OPENAI_API_KEY=
```
### Step 7 : Create an MCP Tool
```
php artisan make:mcp-tool ContactCreatorTool
php artisan make:mcp-tool ContactSearchTool
```

### Step 8 : Create Migration
```
php artisan make:migration create_order_status_table
```
### Step 9 : Create Model
```
app\Models\OrderStatus
```
### Step 9 : Create Seed
```
php artisan make:seed OrderStatusSeed
```
### Step 10 : Run Seed
```
php artisan db:seed
```
### Step 11 : Create MCP Tool
```
php artisan make:mcp-tool OrderStatusFinderTool
php artisan make:mcp-server OrderStatusServer
```

routes/ai.php
<?php

use App\Mcp\Servers\OrderStatusServer;
use Illuminate\Support\Facades\Route;

use Laravel\Mcp\Facades\Mcp;
 
Mcp::web('/mcp/order-status', OrderStatusServer::class);

RUN
php artisan mcp:serve order-status


AGY
nano ~/.gemini/config/mcp_config.json


{
    "mcpServers": {
        "remote-github": {
            "serverUrl": "http://127.0.0.1:8000/mcp/",
            "headers": {
                "Accept": "application/json, text/event-stream",
                "Content-Type": "application/json"
            }
        }
    }
}


{
    "mcpServers": {
        "remote-github": {
            "serverUrl": "http://127.0.0.1:8000/mcp/order-status/",
            "headers": {
                "Accept": "application/json, text/event-stream",
                "Content-Type": "application/json"
            }
        }
    }
}