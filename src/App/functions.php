<?php

declare(strict_types=1);

function dd(mixed $variable)
{
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  die();
}

function e(mixed $value): string
{
  return htmlspecialchars((string) $value);
}

function redirectTo(string $path)
{
  header("Location: {$path}");
  http_response_code(302);
  exit;
}
