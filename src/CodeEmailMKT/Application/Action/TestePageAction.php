<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

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

        $customers = $this->repository->findAll();

        return new HtmlResponse($this->template->render("app::teste",[
            'data' => 'dados passados para o template',
            'customers'=>$customers,
            'minhaClasse' => new \CodeEmailMKT\Minhaclasse()
        ]));
    }
}
