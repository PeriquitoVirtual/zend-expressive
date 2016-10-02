<?php

namespace CodeEmailMKT\Action;

use CodeEmailMKT\Domain\Entity\Category;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class TestePageAction
{

    private $manager;

    public function __construct(EntityManager $manager,Template\TemplateRendererInterface $template = null)
    {
       $this->template = $template;
        $this->manager = $manager;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $category = new Category();
        $category->setName('Nome da minha categoria');

        $this->manager->persist($category);
        $this->manager->flush();

        $categorias = $this->manager->getRepository(Category::class)->findAll();

        return new HtmlResponse($this->template->render("app::teste",[
            'data' => 'dados passados para o template',
            'categorias'=>$categorias,
            'minhaClasse' => new \CodeEmailMKT\Minhaclasse()
        ]));
    }
}
