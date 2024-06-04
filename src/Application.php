<?php


class Application
{
    protected Request $request;
    protected Router $router;
    protected Response $response;
    protected DatabaseManager $databaseManager;
    protected HttpNotFoundException $httpNotFoundException;
    protected heleper $heleper;
    protected Validation $validation;

    public function __construct(array $db)
    {
        $this->httpNotFoundException = new HttpNotFoundException();
        $this->router = new Router();
        $this->response = new Response();
        $this->request = new Request();
        $this->heleper = new heleper();
        $this->validation = new Validation();
        $this->databaseManager = new DatabaseManager();
        $this->databaseManager->connect(
            [
                'hostname' => $db['hostname'],
                'username' => $db['username'],
                'password' => $db['password'],
                'database' => $db['database'],
            ]
        );
    }



    public function run(): void
    {

        try {
            $params = $this->router->resolve($this->request->getPathInfo());
            if (!$params) {
                throw new HttpNotFoundException();
            }
            $controller = $params['controller'];
            $action = $params['action'];
            $this->runAction($controller, $action);
        } catch (HttpNotFoundException) {
            $this->httpNotFoundException->render404Page($this->response);
        }
        $this->response->send();
    }

    public function getdatabaseManager(): DatabaseManager
    {
        return $this->databaseManager;
    }
    public function getRequest(): Request
    {
        return $this->request;
    }
    public function getheleper(): heleper
    {
        return $this->heleper;
    }
    public function getvalidation(): validation
    {
        return $this->validation;
    }

    private function runAction(string $controllerName, string $action): void
    {
        $controllerClass = ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClass)) {
            throw new HttpNotFoundException();
        }
        $controller = new  $controllerClass($this);
        $content = $controller->run($action);
        $this->response->setContent($content);
    }
}
