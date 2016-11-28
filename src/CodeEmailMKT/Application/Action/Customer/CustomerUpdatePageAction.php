<?php

namespace CodeEmailMKT\Application\Action\Customer {


    use CodeEmailMKT\Domain\Entity\Customer;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use Zend\Diactoros\Response\HtmlResponse;
    use Zend\Diactoros\Response\RedirectResponse;
    use Zend\Expressive\Router\RouterInterface;
    use Zend\Expressive\Template;
    use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
    use Zend\Mvc\Controller\Plugin\Redirect;

    class CustomerUpdatePageAction
    {

        private $template;
        /**
         * @var CustomerRepositoryInterface
         */
        private $repository;

        /**
         * CustomerCreatePageAction constructor.
         * @param CustomerRepositoryInterface $repository
         * @param Template\TemplateRendererInterface $template
         * @param RouterInterface $router
         */
        public function __construct(
            CustomerRepositoryInterface $repository,
            Template\TemplateRendererInterface $template,
        RouterInterface $router
        )
        {
            $this->template = $template;
            $this->repository = $repository;
            $this->router = $router;
        }

        public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
        {


           $flash = $request->getAttribute('flash');
            $id = $request->getAttribute('id');
            $customer = $this->repository->find($id);
            if ($request->getMethod() == 'POST'){
                $data = $request->getParsedBody();
                $entity = new Customer();
                $entity->setName($data['name']);
                $entity->setEmail($data['email']);
                $this->repository->create($entity);
                $flash = $request->getAttribute('flash');
                $flash->setMessage('success', 'Contato cadastrado com sucesso');
                $uri = $this->router->generateUri('customer.list');
                return new RedirectResponse($uri);

            }


            return new HtmlResponse($this->template->render("app::customer/update",[
                'customer' => $customer
            ]));


        }
    }
}
