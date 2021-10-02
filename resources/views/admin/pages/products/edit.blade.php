@extends('admin.layouts.app')
@section('title', "Editar Produto { $product->name }")
@section('content')


    <h1>Editar Produto {{ $product->name }}</h1>

<!-- CHAMANDO O METODO POST para a rota update, para editar o registro -->
    <form action="{{ route('products.update', $product->id ) }}" method="POST" enctype="multipart/form-data">

          <!--  TRANSFORMA A REQUISIÇÂO POST EM PUT, mas pode ser simplificado com @ method-->
      <!--  <input type="hidden" name="_method" value="PUT"> -->
        @method('PUT')
        @csrf
        <input type="text" name="name" placeholder="Nome:" value="{{ $product->name }}">
        <input type="text" name="price" placeholder="Preço:" value="{{ $product->price }}">
        <input type="text" name="description" placeholder="Descrição:" value="{{ $product->description }}">
        <button type="submit"> Enviar </button>

    </form>
@endsection
