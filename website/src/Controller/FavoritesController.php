<?php

namespace App\Controller;

use App\Service\Favorites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FavoritesController extends AbstractController
{
    public function index(Favorites $service)
    {
        return $this->render('favorites/index.html.twig', [
            'products' => $service->getCart()
        ]);
    }

    public function add($id, Favorites $service) {

        $service->add($id);

        return $this->redirectToRoute('favorites');

    }

    public function destroy($id, Favorites $service) {

        $service->remove($id);

        return $this->redirectToRoute('favorites');
    }
}
