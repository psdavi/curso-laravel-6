<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


//---------------------------------- EXEMPLO CHAMADA DE ROTAS -----------------------------------


Route::get('/contato', function (){ // Exemplo retorno do texto contato na rota contato
    return 'Contato';
});


/*
Route::get('/', function () {    // Exemplo retorno de texto na rota /
    return 'Olá';
});
*/

/*
Route::get('/empresa', function (){
    return 'Informações da Empresa'; // Exemplo retorno de texto na rota empresa
});
*/


//----------------------------- EXEMPLO CHAMADA DE ROTAS DE VIEWS-----------------------------------

Route::get('/contact', function(){
    return view('contact');
});


//-------------- EXEMPLO CHAMADA DE ROTAS DE VIEWS EM OUTROS DIRETÓRIOS ------------------------

Route::get('/sobre', function (){
    return view('site.sobre');
});


//-------------- EXEMPLO CHAMADA DE ROTAS ANY E MATCH ------------------------

Route::any('/anyteste', function() {
    return 'rota permissao Any ';       // permite o acesso de todos os verbos, get, post, put, etc
});

Route::match(['get', 'post'], '/matchteste', function () {
    return 'matchteste';
});

//permite o acesso de rotas apenas os verbos definidos



//------------------------- EXEMPLO ROTAS COM PARAMETROS ----------- ------------------------


Route::get('/categorias/{nomequalquer}', function($parametro1) {
    return "Produtos da categoria: {$parametro1}";
});
// pega o nome passado na rota e apresenta como categoria


Route::get('/categorias/{nomedacategoria}/posts', function($nomedacategoria) {
    return "Produtos da categoria: {$nomedacategoria}";
});
//pega o nome no meio da rota passado por parametro, dessa vez o valor tem q ser fixo


Route::get('/produtos/{idproduto?}', function ($idproduto = '') {
    return "Produto(s): {$idproduto}";
});


//-------------------EXEMPLO ROTAS REDIRECT e VIEW -------------------------------------------------


Route::get('/redirect1', function (){
    //return "Redirect 01";
    return redirect('/redirect2'); //redireciona para outra rota
});

Route::get('/redirect2', function (){
    return "Redirect 02";
});


// outra forma de redirecionamento de rota

Route::redirect('/redirect1', 'redirect2', 301);

/* redirecionamento de view é melhor passar pelo controller e o controller chamar a view desejada
//não é o caso abaixo, em que chama a view diretamente, pois esse caso é indicado para trabalhar com
// views não importantes
*/

Route::get('/view', function(){
    return view('welcome');
});

//forma simplificada
Route::view('nomedaview', 'welcome');

//-------------------------------- NOMEANDO OU RENOMEANDO ROTAS --------------------------------


//ANTES

Route::get('/redirect3', function (){
    return redirect('/nome-url');
});

Route::get('/nome-url', function (){
    return "Hey";
});

//DEPOIS

Route::get('/redirect3', function (){
    return redirect()->route('url.nombre');
});

Route::get('/nombre-url', function (){
    return "Hey";
})->name('url.nombre');


//-------------------------- AGRUPAMENTO DE ROTAS --------------------------------------------




// middleware impede que acesse a rota sem estar logado
//também pode ser usado o middleware com array
//Route::middleware(['auth', 'exemplo1'])->group(function() {

//Rotas usando prefixo
//Route::prefix('admin')->group(function() {
//as rotas dentro dos grupos e prefixos também podem ter funçoes com parametros normalmente

//ANTES
Route::get('/admin/dashboard', function() {
    return "Home Admin";
})->middleware('auth');

Route::get('/admin/financeiro', function() {
    return "Financeiro Admin";
})->middleware('auth');

Route::get('/admin/produtos', function() {
    return "Produtos Admin";
})->middleware('auth');


//DEPOIS
Route::middleware('auth')->group(function() {

    Route::get('/admin/dashboard', function() {
        return "Home Admin";
    });

    Route::get('/admin/financeiro', function() {
        return "Financeiro Admin";
    });

    Route::get('/admin/produtos', function() {
        return "Produtos Admin";
    });

});


//DEPOIS USANDO PREFIXO

Route::middleware('auth')->group(function() {

    Route::prefix('admin')->group(function() {

        Route::get('/dashboard', function() {
            return "Home Admin";
        });

        Route::get('/financeiro', function() {
            return "Financeiro Admin";
        });

        Route::get('/produtos', function() {
            return "Produtos Admin";
        });

// a rota / chama o prefixo, a raiz do grupo
        Route::get('/', function() {
            return "Admin";
        });

    });

});


//ROTA DO LOGIN PARA TESTE DOS GRUPOS
Route::get('/login', function (){
    return "Login";
})->name('login');



//CHAMANDO A ROTA PELO CONTROLLER

Route::get('/testacontroller', 'App\Http\Controllers\Admin\TesteController@teste');

//ainda é possível simplificar os grupos usando
/*
Route::namespace
Route::name

*/


/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */
//
//    CCCCC   OOOOO   N\    N  TTTTTTT  RRRRR   OOOOO   L       L              RRRRR
//   C        O   O   N \\  N     T     R    R  O   O   L       L      EEEEE   R   R
//   C        O   O   N  \\ N     T     RRRRR   O   O   L       L      E       RRRRR
//   C        O   O   N   \\N     T     R\\     O   O   L       L      EEEEE   R\\
//   C        O   O   N    \N     T     R \\    O   O   L       L      E       R \\
//    \Cccc   OOOOO   N           T     R  \R   OOOOO   LLLLLL  LLLLLL EEEEE   R  \\R
//
/* XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX */

//ROTAS DOS CONTROLLERS


//chama o controller pelo nome e a função desejada dentro dele. Depois é atribuido um nome
Route::get('products', 'App\Http\Controllers\ProductController@index')->name('products.index');

//chama o produto pelo id especifico
Route::get('products/show/{id}', 'App\Http\Controllers\ProductController@show')->name('products.show');


//BLOCO CRIAR
//chama o formulário de criação do produto
Route::get('products/create', 'App\Http\Controllers\ProductController@create')->name('products.create');
//usando post porque vai enviar informação pro banco
Route::post('products/store', 'App\Http\Controllers\ProductController@store')->name('products.store');

//BLOCO EDITAR
//chama o formulário de edição do produto pelo id
Route::get('products/{id}/edit', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
//put para executar a ação de editar o registro
//put é usado para atualizar registros
Route::put('products/{id}', 'App\Http\Controllers\ProductController@update')->name('products.update');


Route::delete('products/{id}', 'App\Http\Controllers\ProductController@destroy')->name('products.destroy');





/*---------------------------------------ROTAS RESOURCE--------------------------------------------*/

//A ROTA RESOURCES subistitue todas as rotas utilizadas acima
/*
Route::resource('products', 'App\Http\Controllers\ProductController');

Route::resource('products', 'App\Http\Controllers\ProductController')->middleware('auth');
//redireciona pra login

*/
