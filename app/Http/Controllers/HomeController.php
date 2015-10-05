<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Auth;
class HomeController extends Controller
{
    protected $layout = 'layouts/master';
    protected $title;

    public function __construct()
    {
       $this->layout = view($this->layout);
    }

    public function index()
    {
		return view('index',['title'=>"Home"]);
    }
    
    
}