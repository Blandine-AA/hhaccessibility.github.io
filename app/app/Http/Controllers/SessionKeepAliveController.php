<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class SessionKeepAliveController extends Controller {
	public function extendLifeOfSession()
	{
		return ['lifetime_in_minutes' => config('session.lifetime')];
	}

}