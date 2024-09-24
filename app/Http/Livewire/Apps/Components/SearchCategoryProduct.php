<?php

namespace App\Http\Livewire\Apps\Components;

use App\Models\ProductCategory;
use Livewire\Component;

class SearchCategoryProduct extends Component
{
  public $product = NULL;
  public $categories = [];
  public $subcategories = [];

  public $product_category_id;
  public $product_subcategory_id;

  public function mount()
  {
    $this->categories = ProductCategory::query()->whereNull("parent_category_id")->get();

    if ($this->product) {
      $this->product_category_id = $this->product->product_category_id;
      $this->product_subcategory_id = $this->product->product_subcategory_id;
    } else {
      $this->product_category_id = $this->categories[0]->id;
    }

    $this->subcategories = ProductCategory::query()->where("parent_category_id", $this->product_category_id)->get();
  }

  public function updatedProductCategoryId()
  {
    $this->subcategories = ProductCategory::query()->where("parent_category_id", $this->product_category_id)->get();
  }

  public function render()
  {
    return view('livewire.apps.components.search-category-product');
  }
}
