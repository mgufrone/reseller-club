<?php namespace Gufy\ResellerClub\Facades;
use Illuminate\Support\Facades\Facade;
class ResellerClub extends Facade
{
  public function getFacadeAccessor()
  {
    return 'rc.api';
  }
}
