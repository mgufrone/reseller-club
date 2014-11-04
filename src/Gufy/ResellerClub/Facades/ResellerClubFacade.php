<?php namespace Gufy\ResellerClub\Facades;
use Illuminate\Support\Facades\Facade;
class ResellerClubFacade extends Facade
{
  public static function getFacadeAccessor()
  {
    return 'rc.api';
  }
}
