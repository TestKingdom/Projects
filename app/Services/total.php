<?php 
namespace app\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function getTotalInventoryValue()
    {
        return Product::select(DB::raw('sum(quantity * price) as total'))->value('total');
    }
}

?>