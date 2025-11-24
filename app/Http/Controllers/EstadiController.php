<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EstadiController extends Controller
{
    public $estadis = [
        ['nom' => 'Estadi Johan Cruyff', 'ciutat' => 'Sant Joan Despí', 'capacitat' => 6000, 'equipPrincipal' => 'FC Barcelona Femení'],
        ['nom' => 'Centro Deportivo Wanda Alcalá de Henares', 'ciutat' => 'Alcalá de Henares', 'capacitat' => 2800, 'equipPrincipal' => 'Atlètic de Madrid Femení'],
        ['nom' => 'Estadio Alfredo Di Stéfano', 'ciutat' => 'Madrid', 'capacitat' => 6000, 'equipPrincipal' => 'Real Madrid Femení'],
    ];

    public function index()
    {
        $estadis = Session::get('estadis', $this->estadis);
        return view('estadis.index', compact('estadis'));
    }

    public function show(int $id)
    {
        $estadis = Session::get('estadis', $this->estadis);
        abort_if(!isset($estadis[$id]), 404);
        $estadi = $estadis[$id];
        return view('estadis.store', compact('estadi'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|min:3',
            'ciutat' => 'required|min:2',
            'equipPrincipal' => 'required|min:3',
            'capacitat' => 'required|integer|min:0',
        ]);

        $estadis = Session::get('estadis', $this->estadis);
        $estadis[] = $validated;
        Session::put('estadis', $estadis);

        return redirect()->route('estadis.index')->with('success', 'Estadi afegit correctament!');
    }
}
