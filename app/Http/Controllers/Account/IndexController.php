<?php namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class IndexController extends Controller {
    
	/**
     * Landing page
     */
    public function index()
    {
        return $this->render('account.index.index', compact('questions'));
    }
}