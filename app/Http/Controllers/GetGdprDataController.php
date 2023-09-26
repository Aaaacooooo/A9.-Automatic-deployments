<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  public function __invoke(int $userId)
  {
    $userId = 5;
    return $userId;
  }


}