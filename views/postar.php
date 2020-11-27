<header>
    <div id="header-plat">
        <div id="icon">
            <img id="icon-img" src=../images/icon.jpg> 
            <h1 id="titulo-geral">CodeBlog </h1>
    </div> 
        </div> 
</header> 
<main>
    <div id="container">
        <form class="form-group" action="<?php echo HOME_URL ?>/posts/novo" method="post">
            <div class="form-group">
                <label id="titulo-postar" for="Titulo"> 
                <img src=../images/post.svg> Faça o seu Post, e colabore com a Comunidade!</label> 
                <input type="text" class="form-control" name="titulo" placeholder="Seu Título">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="postar" placeholder="Crie seu Post">
            </div>
            <button type="submit" class="btn btn-primary"> 
            <img src=../images/save.svg> Postar</button> 
        </form> 
    </div> 
</main>