<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Adapters\ProductsAdapterInterface;
use App\Adapters\Store1ProductsAdapter;
use App\Adapters\Store2ProductsAdapter;
use Exception;

class ProductsController extends Controller
{
    private ProductsAdapterInterface $adapter;

    public function index(): array
    {
        $this->adapter = $this->getStoreAdapter();

        return $this->adapter->getProducts();
    }

    private function getStoreAdapter()
    {
        $currentStore =  env("CURRENT_STORE");
        $currentAdapterClassName = 'App\Adapters\Store' . $currentStore . 'ProductsAdapter';

        // Verifica se o nome da classe corresponde a uma classe válida
        // que implementa a ProductsAdapterInterface
        if (is_a($currentAdapterClassName, ProductsAdapterInterface::class, true))
        {
           return new $currentAdapterClassName;
        }
        else
        {
            throw new Exception("Couldn't find defined store");
        }
    }
}
