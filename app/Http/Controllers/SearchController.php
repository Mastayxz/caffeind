<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');
    $validated = $request->validate([
        'query' => 'nullable|string|max:100', // Limit to 100 characters
        
    ]);

    $products = Product::where('name', 'like', "%{$validated['query']}%")
                      ->orWhere('description', 'like', "%{$validated['query']}%")
                      ->get();
    // $gears = Gear::where('name', 'like', "%{$query}%")
    //                 ->orWhere('description', 'like', "%{$query}%")
    //                 ->get();
 // Combine results
    return view('products.index', compact('products')); // Use a new view for combined results
    }
}
?>