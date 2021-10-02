@extends('admin.layouts.app')

@section('title', 'Cadastrar Novo Produto')

@section('content')
    <h1>Cadastrar Novo Produto</h1>







<!-- CHAMANDO O METODO POST para a rota store, para salvar o registro -->
{{-- enctype="multipart/form-data">  para trabalhar com envio de arquivos--}}

{{-- FORMULARIO CUSTOMIZADO COM class--}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Nome:" class="form-control">
        </div>

        <div class="form-group">
            <input type="text" name="description" placeholder="Descrição:" class="form-control">
        </div>

        <div class="form-group">
            <input type="text" name="price" placeholder="Preço:" class="form-control">
        </div>

        <div class="form-group">
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"> Enviar </button>
        </div>




    </form>
@endsection
