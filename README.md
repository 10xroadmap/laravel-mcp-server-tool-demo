# Laravel MCP Server
## Requirements
- PHP: 8.3 or Higher
- Laravel: 13.8 or Higher
- MySql: 9.3.0 or Higher

## How to run
1. Clone this repository
```
git clone 
```
2. Create `.env` file
```
copy .env.example .env
```

3. Update `.env` file with MySQL connection settings
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mcp-db
DB_USERNAME=root
DB_PASSWORD='Password' 
```
4. Set GEMINI key, or what ever AI provider
```
GEMINI_API_KEY=<some-key>
or
ANTHROPIC_API_KEY=<some-key>
or
OPENAI_API_KEY=<some-key>
``` 
5. Generate encryption key for App
```
php artisan key generate
```
6. run migration
```
php artisan migrate
```
7. run db-seed
```
php artisan db:seed
```
8. run the app
```
php artisan server
```
## Design
1. Database Model

| Model | App\Models\OrderStatus | 
| :--- | :---: | 
| Table | order_status | 
| Fields | order_id(integer),product,status | 

2. Database seed
- Database\Seeders\OrderStatusSeeder
- contains some entries for order status

| order_id | product | status \
| :--- | :---: | :---: | 
| 1 | Noodles | PENDING |
| 2 | Sauce | PROCESSING|

3. MCP Tool
- App\Mcp\Tools\OrderStatusFinderTool
- name : `order-status-finder`
- what it do : Find and return status of order in structured format

4. MCP Server
- App\Mcp\Servers\OrderStatusServer
- name : `Order Status Server`
- contains : One tool (OrderStatusFinderTool), no resources, no prompts

## How to test
- make sure MCP Server is running
- execute `php artisan serve` at terminal to run MCP Server

### Via Postman
1. File -> New -> MCP
2. Request Type : Change from STDIO to HTTP
3. URL : http://127.0.0.1:8000/mcp/order-status
3. Press Connect
4. Now Click Tools::Order Status Finder Tool
5. Enter Order Id as `1` or `2` and Press run
6. Click response at Bottom to View Output

### Via Antigravity CLI
1. Config
Open  ~/.gemini/config/mcp_config.json
Add:
```json
{
    "mcpServers": {
        "order-status": {
            "serverUrl": "http://127.0.0.1:8000/mcp/order-status/",
            "headers": {
                "Accept": "application/json, text/event-stream",
                "Content-Type": "application/json"
            }
        }
    }
}
```
2. Launch Antigravity CLI
```
agy
```

Prompt: `What is the status of order id 2`

## Via ADK 2.0 Agent
```
# mcp_client.py
from google.adk.agents import LlmAgent
from google.adk.tools.mcp_tool import McpToolset
from google.adk.tools.mcp_tool.mcp_session_manager import StreamableHTTPConnectionParams


# Configure connection parameters for the remote HTTP server
connection_params = StreamableHTTPConnectionParams(
    url="http://127.0.0.1:8000/mcp/order-status",
    headers={
        "Accept": "application/json, text/event-stream",
        "Content-Type":"application/json"
    
    } 
)

# Instantiate the toolset
mcp_tools = McpToolset(connection_params=connection_params)

root_agent = LlmAgent(
    model="gemini-2.5-flash-lite",
    name="order_status_agent",
    instruction="""
    You are a helpful assistant who has insight about github accounts
    """,
    tools=[mcp_tools],
)
```
Prompt: `What is the status of order id 2`

## Laravel MCP Documentation
Visit: https://laravel.com/docs/13.x/mcp 

## GIT REPO URL
https://github.com/10xroadmap/agent-skills-using-google-antigravity-cli 

## License or Terms of Use
This project is open-source. However, no part of the source code may be republished, modified, or distributed for commercial or public purposes without giving appropriate credit to the original author.
