<?php

class Controller
{
    protected string $actionName;
    protected Request $request;
    protected DatabaseManager $databaseManager;
    protected heleper $heleper;
    protected Validation $validation;

    public function __construct(Application $application)
    {
        $this->request = $application->getrequest();
        $this->databaseManager = $application->getDatabaseManager();
        $this->heleper = $application->getheleper();
        $this->validation = $application->getvalidation();
    }
    public function run(string $action)
    {
        $this->actionName = $action;
        if (!method_exists($this, $action)) {
            throw new HttpNotFoundException();
        }
        $content = $this->$action();
        return $content;
    }

    protected function render(mixed $variables = [], string $template = null, string $layout = 'layout'): string
    {
        $view = new View(__DIR__ . '/../src/views');

        if (is_null($template)) {
            $template = $this->actionName;
        }
        $controllerName = strtolower(substr(get_class($this), 0, -10));
        $path = $controllerName . '/' . $template;
        return $view->render($path, $variables, $layout);
    }
}
