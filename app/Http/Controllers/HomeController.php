<?php

namespace App\Http\Controllers;

use App\Projeto;
use App\Daily;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $totalAssinantes = Cliente::all();
        $totalProjeto = Projeto::all();
//        $assinaturasPagas = Assinatura::where('status', 3)->get();
        $daily = Daily::all();
        return view('admin.dashboard', compact('totalProjeto', 'daily'));
    }
}
