<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{
  private TemplateEngine $view;
  public function __construct(TemplateEngine $view)
  {
    $this->view = $view;
  }
  public function process(callable $next)
  {
    $this->view->addGlobal('title', 'Expense Tracking App');

    $next();
  }
}
