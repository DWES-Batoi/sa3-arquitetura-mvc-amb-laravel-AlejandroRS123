<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JugadoraController extends Controller
{
    public $jugadoras = [
        ['nom' => 'Alexia Putellas', 'equip' => 'Barça Femení', 'posicio' => 'Migcampista'],
        ['nom' => 'Esther González', 'equip' => 'Atlètic de Madrid', 'posicio' => 'Davantera'],
        ['nom' => 'Misa Rodríguez', 'equip' => 'Real Madrid Femení', 'posicio' => 'Portera'],
    ];

    public function index()
    {
        $jugadoras = Session::get('jugadoras', $this->jugadoras);
        return view('jugadoras.index', compact('jugadoras'));
    }

    public function show(int $id)
    {
        $jugadoras = Session::get('jugadoras', $this->jugadoras);
        abort_if(!isset($jugadoras[$id]), 404);
        $jugadora = $jugadoras[$id];
        return view('jugadoras.store', compact('jugadora'));
    }

    public function create()
    {
        return view('jugadoras.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|min:3',
            'equip' => 'required|min:2',
            'posicio' => 'required|in:Portera,Defensa,Migcampista,Davantera',
        ]);

        $jugadoras = Session::get('jugadoras', $this->jugadoras);
        $jugadoras[] = $validated;
        Session::put('jugadoras', $jugadoras);

        return redirect()->route('jugadoras.index')->with('success', 'jugadora afegit correctament!');
    }
}
