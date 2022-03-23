
@extends('layouts.main')

@section('title', 'Unidade')

@section('body')

<div>
  @include('components.devcomponents.btn-create', ['route' => route('unidade_create')])
</div>

@include('unidade.components.list')

@endsection
