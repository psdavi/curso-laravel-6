
<!--herda o conteudo de app.blade.php, o layout desejado chamado content -->
@extends('admin.layouts.app')



<!-- a section define o conteúdo que estará sendo mostraado dentro do yield content-->
@section('content')

<h1>Exibindo os produtos</h1>
{{!! $teste !!}}

<hr>
<!-- CHAMANDO A ROTA DA VIEW CREATE-->

<a href="{{ route('products.create') }}">Cadastrar</a>


<hr>

@component('admin.components.card')
@slot('title')
<h1>Título Card</h1>


@endslot
Um card de exemplo
@endcomponent

<hr>

@include('admin.includes.alerts', ['content' => 'Alerta de preço de produtos'])

<hr>

@foreach ($produtos as $produto)
    <p>{{ $produto }}</p>
@endforeach




{{--
    <!-- EXEMPLO FORELSE-->
@forelse($produtos as $produto)
    <p>{{ $produto }}</p>
@empty
    <p>Não existem produtos cadastrados</p>
@endempty
@endforelse
--}}






@endsection
