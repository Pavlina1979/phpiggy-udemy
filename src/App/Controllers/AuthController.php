<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class AuthController
{
  private TemplateEngine $view;
  private ValidatorService $validatorService;
  private UserService $userService;
  public function __construct(TemplateEngine $view, ValidatorService $validatorService, UserService $userService)
  {
    $this->view = $view;
    $this->validatorService = $validatorService;
    $this->userService = $userService;
  }
  public function registerView()
  {
    echo $this->view->render('/register.php');
  }

  public function register()
  {
    $this->validatorService->validateRegiste($_POST);

    $this->userService->isEmailTaken($_POST['email']);

    $this->userService->create($_POST);

    redirectTo('/');
  }

  public function loginView()
  {
    echo $this->view->render('/login.php');
  }

  public function login()
  {
    $this->validatorService->validateLogin($_POST);
    $this->userService->login($_POST);

    redirectTo('/');
  }

  public function logout()
  {
    $this->userService->logout();
    redirectTo('/login');
  }
}
