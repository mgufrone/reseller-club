<?php
use Gufy\ResellerClub\ResellerClub;
class ClassTest extends \Orchestra\Testbench\TestCase
{
  public function getPackageProviders()
  {
    return [
      'Gufy\ResellerClub\ResellerClubServiceProvider'
    ];
  }
  public function testFunctionality()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $this->assertEquals('user-id', $class->config('auth-userid'));
    $this->assertEquals('api-key', $class->config('api-key'));
    $class2 = $class->config('hello', 'hai');
    $this->assertEquals($class, $class2);
    $this->assertEquals('hai', $class->config('hello'));
  }

  public function testQuery()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class->from('domains/search')->get();
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals([], $class->config('params'));
  }
  public function testQueryWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class->from('domains/search')
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->get();
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('GET', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }
  public function testGetQueryWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->get('domains/search');
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('GET', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }
  public function testPostWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class->from('domains/search')
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->post();
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('POST', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }
  public function testGetRCWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(false);
    $this->assertTrue(!$class->config('pretend'));
    $data = $class->from('domains/search')
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->post();
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('POST', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }
  public function testPostUrlWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->post('domains/search');
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('POST', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }

  public function testServiceProviders()
  {
    $class = app()->make('rc.api');
    $config = app()->make('config');
    $this->assertEquals($config->get('gufy/rc::auth-userid'), $class->config('auth-userid'));
    $this->assertEquals($config->get('gufy/rc::api-key'), $class->config('api-key'));
  }
  public function testFacades()
  {
    $config = app()->make('config');

    $this->assertEquals($config->get('gufy/rc::auth-userid'), \ResellerClub::config('auth-userid'));
    $this->assertEquals($config->get('gufy/rc::api-key'), \ResellerClub::config('api-key'));
    $response = \ResellerClub::where('no-of-records', 50)
    ->where('ns', ['ns.helloworld.com', 'ns2.helloworld.com'])
    ->get('domains/search.json');
    $params = \ResellerClub::config('params');
    $this->assertEquals(50, $params['no-of-records']);
  }
}
