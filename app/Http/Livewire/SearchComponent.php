<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchComponent extends Component
{
    public $searchTerm = '';
    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->searchTerm . '%')
        ->orWhere('description', 'like', '%' . $this->searchTerm . '%')->get();
        return view('livewire.search-component', compact('products'));
    }
}
