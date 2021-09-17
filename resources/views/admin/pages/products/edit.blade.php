@extends('admin.layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <h1>Editar Produto {{ $id }}</h1>

<!-- CHAMANDO O METODO POST para a rota update, para editar o registro -->
    <form action="{{ route('products.update', $id ) }}" method="POST">

          <!--  TRANSFORMA A REQUISIÇÂO POST EM PUT, mas pode ser simplificado com @ method-->
      <!--  <input type="hidden" name="_method" value="PUT"> -->
        @method('PUT')
        @csrf
        <input type="text" name="name" placeholder="Nome:">
        <input type="text" name="description" placeholder="Descrição:">
        <button type="submit"> Enviar </button>

    </form>
@endsection
