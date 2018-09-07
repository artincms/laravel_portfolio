<?php
Route::group(['prefix' => config('laravel_portfolio_system.backend_lpm_route_prefix'), 'namespace' => 'ArtinCMS\LPM\Controllers', 'middleware' => config('laravel_portfolio_system.backend_lpm_middlewares')], function () {
    //------------------------------------------portfolio---------------------------------------------------------//
    Route::get('/Portfolio', ['as' => 'LPM.Portfolio', 'uses' => 'PortfolioController@index']);
    Route::post('getPortfolio', ['as' => 'LPM.getPortfolio', 'uses' => 'PortfolioController@getPortfolio']);
    Route::post('savePortfolio', ['as' => 'LPM.savePortfolio', 'uses' => 'PortfolioController@savePortfolio']);
    Route::post('getEditPortfolioForm', ['as' => 'LPM.getEditPortfolioForm', 'uses' => 'PortfolioController@getEditPortfolioForm']);
    Route::post('editPortfolio', ['as' => 'LPM.editPortfolio', 'uses' => 'PortfolioController@editPortfolio']);
    Route::post('trashPortfolio', ['as' => 'LPM.trashPortfolio', 'uses' => 'PortfolioController@trashPortfolio']);
    Route::post('trashPortfolioRelated', ['as' => 'LPM.trashPortfolioRelated', 'uses' => 'PortfolioController@trashPortfolioRelated']);
    Route::post('setPortfolioStatus', ['as' => 'LPM.setPortfolioStatus', 'uses' => 'PortfolioController@setPortfolioStatus']);
    Route::post('autoCompletePortfolioLang', ['as' => 'LPM.autoCompletePortfolioLang', 'uses' => 'PortfolioController@autoCompletePortfolioLang']);
    Route::post('autoCompletePortfolioParrent', ['as' => 'LPM.autoCompletePortfolioParrent', 'uses' => 'PortfolioController@autoCompletePortfolioParrent']);
    Route::post('autoCompletePortfolio', ['as' => 'LPM.autoCompletePortfolio', 'uses' => 'PortfolioController@autoCompletePortfolio']);
    Route::post('saveOrderPortfolioForm', ['as' => 'LPM.saveOrderPortfolioForm', 'uses' => 'PortfolioController@saveOrderPortfolioForm']);
    Route::post('addRelatedPortfolio', ['as' => 'LPM.addRelatedPortfolio', 'uses' => 'PortfolioController@addRelatedPortfolio']);
    Route::post('getPortfolioRelatedItem', ['as' => 'LPM.getPortfolioRelatedItem', 'uses' => 'PortfolioController@getPortfolioRelatedItem']);

    Route::post('getAddPortfolioItemForm', ['as' => 'LPM.getAddPortfolioItemForm', 'uses' => 'PortfolioController@getAddPortfolioItemForm']);
    Route::post('savePortfolioItem', ['as' => 'LPM.createPortfolioItem', 'uses' => 'PortfolioController@savePortfolioItem']);
    Route::post('setItemStatus', ['as' => 'LPM.setItemStatus', 'uses' => 'PortfolioController@setPortfolioItemStatus']);
    Route::post('getEditPortfolioItemForm', ['as' => 'LPM.getEditPortfolioItemForm', 'uses' => 'PortfolioController@getEditPortfolioItemForm']);
    Route::post('editPortfolioItem', ['as' => 'LPM.editPortfolioItem', 'uses' => 'PortfolioController@editPortfolioItem']);
    Route::post('trashPortfolioItem', ['as' => 'LPM.trashPortfolioItem', 'uses' => 'PortfolioController@trashPortfolioItem']);
    Route::post('getPortfolioItem', ['as' => 'LPM.getPortfolioItem', 'uses' => 'PortfolioController@getPortfolioItem']);




    //vue Route
    Route::post('getPortfolioFromVue', ['as' => 'LPM.getPortfolioFromVue', 'uses' => 'PortfolioController@getPortfolioFromVue']);
});