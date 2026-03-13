<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    
    private $tours;

    public function __construct()
    {
        $this->tours = new Tours();
    }


    public function index()
    {
        $tours = $this->tours->getAllTour();
        $title = 'Tour';
        $domain = $this->tours->getDomain();
      
        $domainsCount =[
            'mien_bac' => optional($domain->firstWhere('domain','b'))->count,
            'mien_trung' => optional($domain->firstWhere('domain','t'))->count,
            'mien_nam' => optional($domain->firstWhere('domain','n'))->count,
            
        ];
        
        return view('clients.tour', compact('title', 'tours','domainsCount'));
    }

    
}
