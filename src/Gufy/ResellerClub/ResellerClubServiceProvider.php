<?php namespace Gufy\ResellerClub;

use Illuminate\Support\ServiceProvider;

class ResellerClubServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('gufy/reseller-club', 'gufy/rc');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
		$this->app['rc.api'] = $this->app->share(function($app){
			$config = $app->make('config');
			return new ResellerClub($config->get('gufy/rc::auth-userid'), $config->get('gufy/rc::api-key'));
		});
	  $loader = \Illuminate\Foundation\AliasLoader::getInstance();
	  $aliases = \Config::get('app.aliases');

	  // Alias the Datatable package
	  if (empty($aliases['ResellerClub'])) {
	      $loader->alias('ResellerClub', 'Gufy\ResellerClub\Facades\ResellerClubFacade');
		}

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	// public function provides()
	// {
	// 	return array();
	// }

}
