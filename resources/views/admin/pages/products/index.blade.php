
<!--herda o conteudo de app.blade.php, o layout desejado chamado content -->
@extends('admin.layouts.app')



<!-- a section define o conteúdo que estará sendo mostraado dentro do yield content-->
@section('content')

<h1>Exibindo os produtos</h1>


<hr>
<!-- CHAMANDO A ROTA DA VIEW CREATE-->

<a href="{{ route('products.create') }}" class="btn btn-primary" style="background-color: blueviolet">Cadastrar</a>


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

<!-- FORMULARIO DE CAMPO DE PESQUISA -->

<form action="{{ route('products.search') }}" method="post" class="form form-inline">
    @csrf
    <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
    <button type="submit" class="btn btn-info">Pesquisar</button>
</form>





<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preços</th>
            <th>Descrição</th>
            <th width="100">Ações</th>
        </tr>
    </thead>

<tbody>
    @foreach ($products as $product)

    <tr>
        <td>
            @if ($product->image)
            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name }}" style="max-width: 100px;">
        @endif
        </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->description }}</td>
        <td>
            <!-- chamando a rota show, rota que mostra uma pagina pra cada produto-->
            <a href="{{ route('products.edit', $product->id) }}"> Editar</a>

            <!-- chamando a rota show, rota que mostra uma pagina pra cada produto-->
            <a href="{{ route('products.show', $product->id) }}"> Detalhes</a>
        </td>
    </tr>
    @endforeach

</tbody>

</table>

<!-- chama os links do paginate -->

 {{--  {{ $products->links() }} --}}

{{-- PAGINATE DE RESULTADOS DE PESQUISA PESQUISA
 @if (isset($filters))
 {!! $products->appends($filters)->links() !!}
@else
 {!! $products->links() !!}
@endif

--}}








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
