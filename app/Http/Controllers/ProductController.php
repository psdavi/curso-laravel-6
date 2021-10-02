<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

//controllers sempre com o nome no singular e em seguida Controller



class ProductController extends Controller
{

//construtor

    protected $request;
    private $repository;

    public function __construct(Request $request, Product $product)
    {
        $this->request = $request;
        $this->repository = $product;

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

        $products = Product::all();

        //paginate
        // $products = Product::paginate(10);

        //ultimos registros
        // $products = Product::lastest()->paginate();

        $teste = 123;
      //  $products = ['Mouse', 'Teclado' ,'Monitor', 'Cadeira', 'Mesa'];

        return view('admin.pages.products.index', [
            'products' => $products,
        ]);

        /*
        $products = ['Produto 01', 'Produto 02', 'Produto 03'];
        return $products;
*/
         //O laravel já retorna o resultado em json
    }



//a função show recebe o id do produto passado pelo parametro

    public function show($id){
        //return "Exibindo o produto de id: {$id}";


        //outra forma de fazer
        // $product = Product::where('id', $id)->first();

        //se não encontrar produto redireciona de volta de onde veio caso contrario exibe a view com os produtos
        if (!$product = Product::find($id))
        return redirect()->back();

        return view('admin.pages.products.show', [
        'product' => $product
        ]);






    }


//formulário de criação do produto
    public function create(){
        //return 'Exibindo o formulário de cadastro do produto';

        return view('admin.pages.products.create');
    }


//formulário de edição do produto escolhido pelo ID
    public function edit($id){
        //return "Exibindo o formulário de edição do produto: {$id}";




        if (!$product = $this->repository->find($id))
        return redirect()->back();


//se n passar no compact, da erro de variavel indefinida
        //retorna a view com o id do produto
        return view('admin.pages.products.edit', compact('product'));

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
/*
if( $request->file('photo')->isValid() ){

//funciona das duas formas, o nome photo é o msm do form
// store salva o arquivo e cria a pasta products dentro de storage/app

//dd($request->file('photo')->store('products'));
//$request->photo;

//pegando o nome enviado no campo nome e concatenando com a extensão do arquivo
$nameFile = $request->name . '.' . $request->photo->extension();
dd($request->file('photo')->storeAs('fotospublicas', $nameFile));

}
*/

    //seleciono os dados q quero inserir e salvo em dados
    //isso esta sendo usado para ignorar a coluna de imagem
        $dados = $request->only(['name', 'description', 'price']);




        if ($request->hasFile('image') && $request->image->isValid()) {
            //upload simples
        //dd($request->image->store('products'));


        $imagePath = $request->image->store('products');

        $data['image'] = $imagePath;
    }





        //cria o produto
        //desse modo precisa preencher o fillable no model
        //erro mass assignment

        //sem repository
        Product::create($dados);

        return redirect()->route('products.index');

    }


//função que executa a edição do registro escolhido pelo id
    public function update(Request $request, $id){
        //return "Editando o produto: {$id}";

        //verifica se encontra o id do produto
        if (!$product = $this->repository->find($id))
        return redirect()->back();

        //traz todos os dados do form
        $product->update($request->all());
        return redirect()->route('products.index');


    }


    //função que executa a exclusão do registro escolhido pelo id
    public function destroy($id){

        //com repository
        $product = $this->repository->where('id', $id)->first();


       //caso n encontre e produto
        if (!$product)
            return redirect()->back();

            // caso encontre

            //deleta e redireciona
            $product->delete();

            return redirect()->route('products.index');
    }


    /**
     * Search Products
     */

     //TAMBÉM É TRATADO NO MODEL DE PRODUCTS e na rota
    public function search(Request $request)
    {
        //pega tudo menos o token, pra ficar mais limpo a url
        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters,
        ]);
    }


}
