<?php

namespace App\MyTraits;

use App\Product;

trait Productive
{

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function createProduct($data)
    {
        return $this->products()->create($data);
    }

    public function updateProduct($data)
    {
        return $this->products()->update($data);
    }
}
