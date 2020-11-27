<?php

class Posts
{
    //Primeira função, ela é responsável por criar e captar os posts e titulos, e inserir no banco de dados
    public function novo(){
        $mongo = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $mongo->BlogMongo->Posts;

        $posts = $_POST['postar'];
        $title = $_POST['titulo'];
        $insertOneResult = $collection->insertOne([
            "posts" => "$posts",
            "title" => "$title",
        ]);

        header("location:" . HOME_URL);
    }

    //Responsável por mostrar a função MOSTRAR na tela principal
    public function index(){
        $this::mostrar();
    }

   //Responsável por mostrar os Cards!
    public function mostrar(){
        //Inclui a pagina home
        include PATH . "/views/home.php";
        //Conecta-se com o Banco de Dados
        $mongo = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $mongo->BlogMongo->Posts;
        //Responsável por captar sempre o ultimo card inserido
        $configs = ['sort' => ['_id' => -1]];
        $result = $collection->find([],$configs);
        //Responsável por pegar o resultado e mostrar na tela!
        foreach ($result as $pegarResult) {

            echo ("
            <div id='postagens' class='card text-white bg-primary mb-3 post' style='max-width: 18rem;'>
                <div class='card-header'>".$pegarResult['title']."<a href='".HOME_URL."/Posts/deletePost/".$pegarResult['_id']."'>
                <img id='lixo' src=".HOME_URL."/images/delete.svg></a> </div>
                    <div class='card-body'>
                    <p class='card-text' id=" . $pegarResult['_id'] . ">" . substr($pegarResult['posts'], 0, 180) . "
                    <a href=" . HOME_URL . "Posts/ler/" . $pegarResult['_id'] . "></a> </p>
                </div>
            </div>
            ");
        }
    }


    //Função responsável por deletar um Post
    public function deletePost($idPost = null){
        //Checa se o ID não é nulo
        if(!$idPost){   
            include PATH."./views/erro404.php";
        }else{
            //Conexão com o Banco e a Coleção
            $mongo = new MongoDB\Client("mongodb://localhost:27017");
            $collection = $mongo->BlogMongo->Posts;
            //Deleta um elemento da Coleção
            $collection -> deleteOne([
                '_id' => new MongoDB\BSON\ObjectID("$idPost")
            ]);
        }

        header('location:'.HOME_URL);
    }

    //Responsável por abrir a página POSTAR
    public function postar(){
        include PATH . "/views/postar.php";
    }
}
