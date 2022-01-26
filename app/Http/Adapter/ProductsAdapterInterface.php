<?php

namespace App\Http\Adapter;

interface ProductsAdapterInterface
{
    public function getProducts(): array;
}
