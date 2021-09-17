@extends('admin.layouts.app')

@section('title', 'Cadastrar Novo Produto')

@section('content')
    <h1>Cadastrar Novo Produto</h1>

<!-- CHAMANDO O METODO POST para a rota store, para salvar o registro -->
{{-- enctype="multipart/form-data">  para trabalhar com envio de arquivos--}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Nome:">
        <input type="text" name="description" placeholder="Descrição:">
        <input type="file" name="photo">
        <button type="submit"> Enviar </button>

    </form>
@endsection
