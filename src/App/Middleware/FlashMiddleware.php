<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class FlashMiddleware implements MiddlewareInterface
{
  private TemplateEngine $view;
  public function __construct(TemplateEngine $view)
  {
    $this->view = $view;
  }
  public function process(callable $next)
  {
    $this->view->addGlobal('errors', $_SESSION['errors'] ?? []);
    unset($_SESSION['errors']);

    $next();
  }
}
