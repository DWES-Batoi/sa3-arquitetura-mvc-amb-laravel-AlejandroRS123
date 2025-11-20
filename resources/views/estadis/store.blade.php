@extends('layouts.app')
@section('title', "Detall d'Estadi")

@section('content')
<x-estadi :nom="$estadi['nom']" :ciutat="$estadi['ciutat']" :capacitat="$estadi['capacitat']" :equipPrincipal="$estadi['equipPrincipal']" />
@endsection