<?php

namespace App\Adapters;

class Store2ProductsAdapter implements ProductsAdapterInterface
{
    private string $receivedProducts = '
    {
        "products": [
            {
                "prod_id": 1,
                "prod_name": "Handmade Product",
                "prod_description": "A new handmade awesome product",
                "prod_score": "97",
                "prod_in_stock": "12",
                "prod_price": "52.3"
            },
            {
                "prod_id": 2,
                "prod_name": "Luxury Product",
                "prod_description": "A new awesome product",
                "prod_score": "100",
                "prod_in_stock": "8",
                "prod_price": "94.5"
            }
        ],
        "main page": "http://www.simplestore.com/"
    }';

    public function getProducts(): array
    {
        $products = $this->adaptProducts($this->receivedProducts);

        return $products;
    }

    private function adaptProducts(string $receivedProductsJson): array
    {
        $receivedProductsArray = json_decode($receivedProductsJson, true);
        $adaptedProducts = [];

		// Estamos interessados apenas no objeto 'products' do array
        foreach ($receivedProductsArray['products'] as $receivedProduct) {
            $score = $receivedProduct['prod_score'] / 20;

            $adaptedProducts[] = [
                'id' => "STORE2_{$receivedProduct['prod_id']}",
                'name' => $receivedProduct['prod_name'],
                'price' => (float)($receivedProduct['prod_price']),
                'description' => $receivedProduct['prod_description'],
                'score' => $score,
                'quantity_in_stock' => (int)($receivedProduct['prod_in_stock']),
            ];
        }

        return $adaptedProducts;
    }
}
