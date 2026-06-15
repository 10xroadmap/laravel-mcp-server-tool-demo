<?php

namespace App\Mcp\Tools;

use App\Models\OrderStatus;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Name;
use stdClass;

#[Name('order-status-finder')]
class OrderStatusFinderTool extends Tool
{
    /**
     * Get the tool's input schema.
     *
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'order_id' => $schema->integer()
                ->description('Order Id to be processed')
                ->required()
        ];
    }
    public function outputSchema(JsonSchema $schema): array
    {
        return [
            'order_id' => $schema->number()->description('Order id')->required(),
            'product' => $schema->string()->description('Product')->required(),
            'status' => $schema->string()->description('Status of Order')->required(),
        ];
    }
    public function handle(Request $request)
    {
        # Validate Incoming parameters
        $validated = $request->validate([
            'order_id' => 'required|numeric'
        ]);
        # Fetch related record
        $record = OrderStatus::where([
            ['order_id', '=', $validated['order_id']]
        ])->first();
        # Generate Response
        if ($record) {
            return Response::structured([
                'order_id' => $record->order_id,
                'product' => $record->product,
                'status' => $record->status,
            ]);
        } else {
            return Response::error('Unable to fetch order for the given order id');
        }
    }
}
