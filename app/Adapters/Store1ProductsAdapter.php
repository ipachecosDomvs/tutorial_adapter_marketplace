<?php

namespace App\Adapters;

class Store1ProductsAdapter implements ProductsAdapterInterface
{
    private string $receivedProducts = '[
        {
            "id":1,
            "nome":"Novo Produto",
            "preco":"23.99",
            "descricao":"Um novo produto",
            "nota":"9.7",
            "qtd_estoque":"23"
        },
        {
            "id":2,
            "nome":"Mais um Produto",
            "preco":"18.99",
            "descricao":"Um novo produto",
            "nota":"9.6",
            "qtd_estoque":"12"
        }
    ]';

    public function getProducts(): array
    {
        $products = $this->adaptProducts($this->receivedProducts);

        return $products;
    }

    private function adaptProducts(string $receivedProductsJson): array
    {
        $receivedProductsArray = json_decode($receivedProductsJson, true);
        $adaptedProducts = [];

        foreach ($receivedProductsArray as $receivedProduct) {
            $score = $receivedProduct['nota'] / 2;

            $adaptedProducts[] = [
                'id' => "STORE1_{$receivedProduct['id']}",
                'name' => $receivedProduct['nome'],
                'price' => (float)($receivedProduct['preco']),
                'description' => $receivedProduct['descricao'],
                'score' => $score,
                'quantity_in_stock' => (int)($receivedProduct['qtd_estoque']),
            ];
        }

        return $adaptedProducts;
    }
}
