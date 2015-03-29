<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class QuestionsController extends Controller {
    
	/**
     * Landing page
     */
    public function index()
    {
        return view('admin.index.index', compact('questions'));
    }
}