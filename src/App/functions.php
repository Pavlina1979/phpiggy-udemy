<?php

declare(strict_types=1);

function dd(mixed $variable)
{
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  die();
}