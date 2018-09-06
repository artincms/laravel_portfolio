<?php
Route::group(['prefix' => config('laravel_portfolio_system.backend_lpm_route_prefix'), 'namespace' => 'ArtinCMS\LPM\Controllers', 'middleware' => config('laravel_portfolio_system.backend_lpm_middlewares')], function () {
    //------------------------------------------portfolio---------------------------------------------------------//
    Route::get('/', ['as' => 'LPM.Portfolio', 'uses' => 'PortfolioController@index']);
    Route::post('getPortfolio', ['as' => 'LPM.getPortfolio', 'uses' => 'PortfolioController@getPortfolio']);
    Route::post('savePortfolio', ['as' => 'LPM.savePortfolio', 'uses' => 'PortfolioController@savePortfolio']);
    Route::post('getEditPortfolioForm', ['as' => 'LPM.getEditPortfolioForm', 'uses' => 'PortfolioController@getEditPortfolioForm']);
    Route::post('editPortfolio', ['as' => 'LPM.editPortfolio', 'uses' => 'PortfolioController@editPortfolio']);
    Route::post('trashPortfolio', ['as' => 'LPM.trashPortfolio', 'uses' => 'PortfolioController@trashPortfolio']);
    Route::post('trashPortfolioRelated', ['as' => 'LPM.trashPortfolioRelated', 'uses' => 'PortfolioController@trashPortfolioRelated']);
    Route::post('setPortfolioStatus', ['as' => 'LPM.setPortfolioStatus', 'uses' => 'PortfolioController@setPortfolioStatus']);
    Route::post('autoCompletePortfolioLang', ['as' => 'LPM.autoCompletePortfolioLang', 'uses' => 'PortfolioController@autoCompletePortfolioLang']);
    Route::post('autoCompletePortfolioParrent', ['as' => 'LPM.autoCompletePortfolioParrent', 'uses' => 'PortfolioController@autoCompletePortfolioParrent']);
    Route::post('saveOrderPortfolioForm', ['as' => 'LPM.saveOrderPortfolioForm', 'uses' => 'PortfolioController@saveOrderPortfolioForm']);
    Route::post('addRelatedPortfolio', ['as' => 'LPM.addRelatedPortfolio', 'uses' => 'PortfolioController@addRelatedPortfolio']);
    Route::post('getPortfolioRelatedItem', ['as' => 'LPM.getPortfolioRelatedItem', 'uses' => 'PortfolioController@getPortfolioRelatedItem']);

    //vue Route
    Route::post('getPortfolioFromVue', ['as' => 'LPM.getPortfolioFromVue', 'uses' => 'PortfolioController@getPortfolioFromVue']);
});