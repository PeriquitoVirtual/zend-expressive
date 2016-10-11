<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Entity\Category;
use CodeEmailMKT\Domain\Entity\Customer;
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

use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class TestePageAction
{

    private $manager;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    public function __construct(CustomerRepositoryInterface $repository,Template\TemplateRendererInterface $template = null)
    {
       $this->template = $template;
       $this->repository = $repository;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
       $customer = new Customer();
        $customer->setName("Cícero Machado");
        $customer->setEmail("cicero.ice@gmail.com");

        $this->repository->create($customer);

        //$categorias = $this->manager->getRepository(Category::class)->findAll();

        return new HtmlResponse($this->template->render("app::teste",[
            'data' => 'dados passados para o template',
            'categorias'=>[],
            'minhaClasse' => new \CodeEmailMKT\Minhaclasse()
        ]));
    }
}
