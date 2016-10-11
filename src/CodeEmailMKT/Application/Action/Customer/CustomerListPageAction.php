<?php

namespace CodeEmailMKT\Application\Action\Customer;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerListPageAction
{

    private $template;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    public function __construct(CustomerRepositoryInterface $repository,
                                Template\TemplateRendererInterface $template = null)
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

        $customers = $this->repository->findAll();

        return new HtmlResponse($this->template->render("app::teste",[
            'customers'=>$customers,
         ]));
    }
}
