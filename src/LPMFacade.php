<?php
namespace ArtinCMS\LGS;
use Illuminate\Support\Facades\Facade;

class LPMFacade extends Facade
{
	protected static function getFacadeAccessor() {
		return 'LPM';
	}
}