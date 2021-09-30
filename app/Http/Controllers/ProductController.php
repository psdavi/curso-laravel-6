<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//controllers sempre com o nome no singular e em seguida Controller



class ProductController extends Controller
{

//construtor

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // trabalhando com middlewares no controller
        /*
        $this->middleware('auth');      //redireciona pra login
        */

        /*
        $this->middleware('auth')->only('create');
//      solicita login apenas pro metodo create

//ou usando array
        $this->middleware('auth')->only(['create', 'store']);

// ou usando o except no lugar do only pra fazer o contrário (todos exceto 1 ou todos exceto alguns)
*/


    }





    //AQUI VAI AS FUNÇÕES DO CONTROLLER

    public function index(){


        $teste = 123;
        $produtos = ['Mouse', 'Teclado' ,'Monitor', 'Cadeira', 'Mesa'];

        return view('admin.pages.products.index', compact('teste', 'produtos'));

        /*
        $products = ['Produto 01', 'Produto 02', 'Produto 03'];
        return $products;
*/
         //O laravel já retorna o resultado em json
    }



//a função show recebe o id do produto passado pelo parametro

    public function show($id){
        return "Exibindo o produto de id: {$id}";
    }


//formulário de criação do produto
    public function create(){
        //return 'Exibindo o formulário de cadastro do produto';

        return view('admin.pages.products.create');
    }


//formulário de edição do produto escolhido pelo ID
    public function edit($id){
        //return "Exibindo o formulário de edição do produto: {$id}";

        //retorna a view com o id do produto
        return view('admin.pages.products.edit', compact('id'));

    }

// TRABALHANDO COM REQUEST E ENVIO DE IMAGEM

//função que executa a criação do registro
    public function store(Request $request){
       // return 'Cadastrando um novo produto';

       //traz todos os registros
       //dd($request->all());

        //traz os registros desejados
        // dd($request->only(['name', 'description']));

        //pega somente o valor do campo desejado, nome, select, etc
        //dd($request->name);

        //pega todos, exceto...
       // dd($request->except('name'));

//dd('cadastrando...');


// REQUEST PARA ARQUIVOS / FOTOS
//isValid serve para verificar se o arquivo é válido ou se não está corrompido

if( $request->file('photo')->isValid() ){

//funciona das duas formas, o nome photo é o msm do form
// store salva o arquivo e cria a pasta products dentro de storage/app

//dd($request->file('photo')->store('products'));
//$request->photo;

//pegando o nome enviado no campo nome e concatenando com a extensão do arquivo
$nameFile = $request->name . '.' . $request->photo->extension();
dd($request->file('photo')->storeAs('fotospublicas', $nameFile));

}

    }


//função que executa a edição do registro escolhido pelo id
    public function update($id){
        //return "Editando o produto: {$id}";
        dd("Editando o produto {$id}");
    }


    //função que executa a exclusão do registro escolhido pelo id
    public function destroy($id){
        return "Deletando o produto: {$id}";
    }


}
