<?php

declare(strict_types=1);

namespace Framework\Exceptions;

use RuntimeException;

class ValidationException extends RuntimeException
{
  public array $errors = [];
  public function __construct(array $errors, int $code = 422)
  {
    parent::__construct(code: $code);
    $this->errors = $errors;
  }
}
