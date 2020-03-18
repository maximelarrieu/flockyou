<?php

namespace App\Service;

use App\Entity\League;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class LeaguePagination {
    private $entityClass;
    private $limit = 8;
    private $currentPage = 1;
    private $manager;
    private $twig;
    private $route;
    private $templatePath;
    private $league;

    public function __construct(ObjectManager $manager, Environment $twig, RequestStack $request, $templatePath, $league)
    {
        $this->route        = $request->getCurrentRequest()->attributes->get('_route');
        $this->manager      = $manager;
        $this->twig         = $twig;
        $this->templatePath = $templatePath;
        $this->league       = $league;
    }

    public function setTemplatePath($templatePath) {
        $this->templatePath = $templatePath;

        return $this;
    }

    public function getTemplatePath($templatePath) {
        return $this->templatePath;
    }

    public function display(League $league) {
        $this->twig->display($this->templatePath, [
            'league' => $this->league,
            'page' => $this->currentPage,
            'nbPages' => $this->getPages(),
            'route' => $this->route
        ]);
    }

    public function setRoute($route) {
        $this->route = $route;

        return $this;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getData() {
        $offset = $this->currentPage * $this->limit - $this->limit;
        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findBy([], [], $this->limit, $offset);

        return $data;
    }

    public function getPages() {
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());

        $nbPages = ceil($total / $this->limit);

        return $nbPages;
    }

    public function setPage($page)
    {
        $this->currentPage = $page;
        return $this;
    }

    public function getPage()
    {
        return $this->currentPage;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function setEntityClass($entityClass) {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }
}