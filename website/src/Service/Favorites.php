<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Favorites {

    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    public function add(int $id) {
        $favorites = $this->session->get('favorites', []);

        if(!empty($favorites[$id])) {
            $favorites[$id]++;
        } else {
            $favorites[$id] = 1;
        }
        $this->session->set('favorites', $favorites);
    }

    public function remove(int $id) {
        $favorites = $this->session->get('favorites', []);

        if(!empty($favorites[$id])) {
            unset($favorites[$id]);
        }

        $this->session->set('favorites', $favorites);
    }

    public function getCart() : array {
        $favorites = $this->session->get('favorites', []);

        $favoritesWithData = [];

        foreach($favorites as $id => $quantity) {
            $favoritesWithData[] = [
                'product' => $this->productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $favoritesWithData;
    }
//
//    public function getTotal() : float {
//        $total = 0;
//
//        foreach ($this->getCart() as $product) {
//            $total += $product['product']->getPrice() * $product['quantity'];
//        }
//
//        return $total;
//    }

    public function nbProducts() : int {
        $nbProducts = 0;
        foreach ($this->getCart() as $product) {
            $nbProducts += count(array($product['product']));
        }

        return $nbProducts;
    }
}