<?php
Route::group(['prefix' => config('laravel_portfolio_system.backend_lpm_route_prefix'), 'namespace' => 'ArtinCMS\LPM\Controllers', 'middleware' => config('laravel_portfolio_system.backend_lpm_middlewares')], function () {
    //------------------------------------------portfolio---------------------------------------------------------//
    Route::group(['prefix' => 'Portfolio'], function () {
        Route::get('/', ['as' => 'LPM.Portfolio', 'uses' => 'PortfolioController@index']);
        Route::post('getPortfolio', ['as' => 'LPM.Portfolio.getPortfolio', 'uses' => 'PortfolioController@getPortfolio']);
        Route::post('savePortfolio', ['as' => 'LPM.Portfolio.savePortfolio', 'uses' => 'PortfolioController@savePortfolio']);
        Route::post('getEditPortfolioForm', ['as' => 'LPM.Portfolio.getEditPortfolioForm', 'uses' => 'PortfolioController@getEditPortfolioForm']);
        Route::post('editPortfolio', ['as' => 'LPM.Portfolio.editPortfolio', 'uses' => 'PortfolioController@editPortfolio']);
        Route::post('trashPortfolio', ['as' => 'LPM.Portfolio.trashPortfolio', 'uses' => 'PortfolioController@trashPortfolio']);
        Route::post('trashPortfolioRelated', ['as' => 'LPM.Portfolio.trashPortfolioRelated', 'uses' => 'PortfolioController@trashPortfolioRelated']);
        Route::post('setPortfolioStatus', ['as' => 'LPM.Portfolio.setPortfolioStatus', 'uses' => 'PortfolioController@setPortfolioStatus']);
        Route::post('autoCompletePortfolioLang', ['as' => 'LPM.Portfolio.autoCompletePortfolioLang', 'uses' => 'PortfolioController@autoCompletePortfolioLang']);
        Route::post('autoCompletePortfolio', ['as' => 'LPM.Portfolio.autoCompletePortfolio', 'uses' => 'PortfolioController@autoCompletePortfolio']);
        Route::post('saveOrderPortfolioForm', ['as' => 'LPM.Portfolio.saveOrderPortfolioForm', 'uses' => 'PortfolioController@saveOrderPortfolioForm']);
        Route::post('addRelatedPortfolio', ['as' => 'LPM.Portfolio.addRelatedPortfolio', 'uses' => 'PortfolioController@addRelatedPortfolio']);
        Route::post('getPortfolioRelatedItem', ['as' => 'LPM.Portfolio.getPortfolioRelatedItem', 'uses' => 'PortfolioController@getPortfolioRelatedItem']);

        //vue Route
        Route::post('getPortfolioFromVue', ['as' => 'LPM.Portfolio.getPortfolioFromVue', 'uses' => 'PortfolioController@getPortfolioFromVue']);
    });
});