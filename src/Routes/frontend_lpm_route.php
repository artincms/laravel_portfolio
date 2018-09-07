<?php
Route::group(['prefix' => config('laravel_portfolio.frontend_lpm_route_prefix'), 'namespace' => 'ArtinCMS\LPM\Controllers', 'middleware' => config('laravel_portfolio.frontend_lpm_middlewares')], function () {
    Route::post('getPortfolioAjax', ['as' => 'LPM.getPortfolioAjax', 'uses' => 'PortfolioController@getPortfolioAjax']);
    Route::post('getPortfolioItemAjax', ['as' => 'LPM.getPortfolioItemAjax', 'uses' => 'PortfolioController@getPortfolioItemAjax']);
    Route::post('getPort', ['as' => 'LPM.getPort', 'uses' => 'PortfolioController@getPort']);
});