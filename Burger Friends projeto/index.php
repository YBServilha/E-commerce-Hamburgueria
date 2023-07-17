<?php
  session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="view/css/estilo1.css" rel="stylesheet">
    <title>Burger Friends - Home</title>
    <link rel="stylesheet" href="view/css/estilo2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;800&family=Rubik+Dirt&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Cabeçalho/Menu-->
  <nav id="navbar"class="navbar navbar-expand-lg navbar-light bg-dark">
      <a class="navbar-brand col-5" href="./ind.php"><img src="view/img/logo1.png" alt="Logo" id="logo"></a>
      <button class="navbar-toggler toggleButton" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <?php 
            require_once("model/Manager.php");
            $manager = new Manager();
            $dados = $manager->pegaMenusSubmenus("r");

            $keyMenu = array();
            $keySub = array();

            /*
            echo "<pre>";
            var_dump($dados);
            echo "</pre>";
            exit();
            */
            if(isset($dados['num'])){
              if($dados['num'] > 0){
                for($i = 0;$i < $dados['num'];$i++){ //menu
                    if(isset($dados[$i]['menuId'])){
                      //$reMenu = array_search($dados[$i]['menuNome'],$keyMenu,true);
                      $reMenu = in_array($dados[$i]['menuNome'],$keyMenu);
                      if($reMenu == 0){
                        echo "<li class='nav-item dropdown'>";
                        echo "<a class='nav-link dropdown-toggle text-light' href='" . $dados[$i]["menuURL"] . "' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $dados[$i]["menuNome"] . "</a>";
                        $keyMenu[$i] = $dados[$i]['menuNome'];
                        $drop = 0;
                        for($ii = 0;$ii <= $dados['num'];$ii++){ 
                          if(isset($dados[$ii]['subId'])){
                            //$reSub = array_search($dados[$ii]['subURL'],$keySub,true);
                            $reSub = in_array($dados[$ii]['subURL'],$keySub);
                            if($dados[$i]['menuId'] == $dados[$ii]['subId'] && $reSub == ""){
                                if($drop == 0){
                                  echo "<div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
                                  $drop = 1;
                                }
                                echo "<a class='dropdown-item' href='" . $dados[$ii]['subURL'] . "'>" . $dados[$ii]['subNome'] . "</a>";
                                $keySub[$i] = $dados[$ii]['subNome'];
                            }
                          }
                          
                        }
                        if($drop == 1){
                          echo "</div>";
                        }
                        echo "</li>";
                      }
                    }
                }
              }
            }else{

            }
          
            

          ?>
          <li class="nav-item">
            <a class="nav-link text-light" href="#quem-somos">Sobre <span class="sr-only">(Página atual)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" href="#localizacao">Localização</a>
          </li>

          <!--<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light" href="view/cardapio.html" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Cardápio
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="view/cardapio.php">Mais pedidos</a>
                <a class="dropdown-item" href="#">Monte o seu!</a>
                <a class="dropdown-item" href="view/cardapio.php#acompanhamentos">Acompanhamentos</a>
                <a class="dropdown-item" href="view/cardapio.php#bebidas">Bebidas</a>
                <a class="dropdown-item" href="view/cardapio.php#sobremesas">Sobremesas</a>
              </div>
            </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#quem-somos">Sobre <span class="sr-only">(Página atual)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#localizacao">Localização</a>
          </li>
      </div>-->
      
      </ul>
      </div>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link mr-2 mt-1" id="login" href="view/login.php">LogIn <span class="sr-only">(Página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-5 mt-1" id="signin" href="view/cadastro-teste.php">SignIn <span class="sr-only">(Página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view/carrinho.php"><ion-icon name="cart-outline" id="icon-carrinho" class="text-light"></ion-icon><span class="sr-only">(Página atual)</span></a>
            </li>
            <?php if(isset($_SESSION['USER-ID'])){ ?>
            <li class="nav-item">
              <a class="nav-link mr-2 mt-1" id="Logout" href="view/logout.php">Logout<span class="sr-only">(Página atual)</span></a>
            </li>
            <?php } ?>
            

          </ul>
        </div>
    </nav>

      <!-- FIM Cabeçalho/Menu-->
    
      <!-- Carrossel de imagens-->
  <div id="carouselExampleIndicators" class="carousel slide carrossel-main" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block img-carrossel" src="view/img/carrossel1.jpeg" alt="Primeiro Slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-carrossel" src="view/img/carrossel2.png" alt="Segundo Slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-carrossel" src="view/img/carrossel3.png" alt="Terceiro Slide">
        </div>
      </div>
      <a class="carousel-control-prev carrossel-space" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon carrossel-btn" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next carrossel-space2" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon carrossel-btn2" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
      </a>
    </div>
<!-- FIM Carrossel de imagens-->
<!-- Categorias do cardápio -->
  <h2 class="titulo-cardapio rubik">Nosso Cardápio:</h2>
  <section class="categorias">
    <div class="principais">
      <div class="monte">
        <img src="view/img/monteSeu.jpeg" alt="Monte o seu" class="categoria-img">
        <a href="view/monte-seu.php" class="btn-categorias rubik">Monte o seu!</a>
      </div>
      <div class="hamburgures">
        <img src="view/img/hamburgueres.jpeg" alt="Monte o seu" class="categoria-img">
        <a href="view/cardapio.php" class="btn-categorias rubik">Hambúrgueres</a>
      </div>
    </div>
    <div class="secundarias">
      <div class="acompanhamentos">
        <img src="view/img/acompanhamentos.jpeg" alt="Acompanhamentos" class="categoria-img">
        <a href="view/cardapio.php#acompanhamentos" class="btn-second-categorias rubik">Acompanhamentos</a>
      </div>
      <div class="bebidas">
        <img src="view/img/bebidas.jpeg" alt="Bebidas" class="categoria-img">
        <a href="view/cardapio.php#bebidas" class="btn-second-categorias rubik">Bebidas</a>
      </div>
      <div class="sobremesas">
        <img src="view/img/sobremesas.jpeg" alt="Sobremesas" class="categoria-img">
        <a href="view/cardapio.php#sobremesas" class="btn-second-categorias rubik">Sobremesas</a>
      </div>
    </div>
  </section>
<!-- FIM Categorias do cardápio-->
<!-- Quem somos? -->
  <h2 class="titulo-cardapio rubik" id="quem-somos">Quem somos?</h2>
  <section class="quem-somos">
    <div class="imagem">
      <img src="view/img/restaurante.jpg" alt="Quem somos">
    </div>
    <div class="texto">
      <p>Quem somos: A empresa Burger Friends foi criada em 20/02/2022, nossa empresa está ligada a venda de hambúrgueres e complementos mais especializados para o ramo Gourmet, atualmente estamos na Rua Darwin, 618
      Jd. Santo Amaro – São Paulo/SP, nossos serviços são prestados a partir da nossa loja física e da nossa loja virtual, com a finalidade de entregar os melhores e mais saborosos lanches da região.</p>
    </div>
  </section>
  <!-- FIM Quem somos? -->
  <!-- Localização -->

  <h2 class="titulo-localizacao mt-4 rubik" id="localizacao">Nossa localização:</h2>
  <section class="localizacao">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3655.7311273530554!2d-46.6991563844057!3d-23.613973869423877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce50ceee6fd2cf%3A0x228e8bc004a4e470!2sETEC%20Jornalista%20Roberto%20Marinho!5e0!3m2!1spt-BR!2sbr!4v1669988899514!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </section>
  <!-- FIM Localização -->
  <!-- Footer -->
  <footer class="bg-dark">
    <div class="logo-rodape"><img src="view/img/logo1.png" alt="Logo"></div>
    <p class="text-light">Burger Friends - Todos os direitos reservados &copy2022</p>
    <div class="redes-sociais">
      <h2>Siga em nossas redes sociais:<a href="https://www.facebook.com/profile.php?id=100088285543880" target="_blank"><ion-icon name="logo-facebook" class="first-icon-footer"></a><a href="https://www.instagram.com/_burger_friends/" target="_blank"></ion-icon><ion-icon name="logo-instagram"></ion-icon></a></h2>
    </div>
  </footer>
<!-- FIM Footer -->



<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<?php
    //ALERTA DE MENSAGEM
    if(isset($_POST['msg'])){
        require_once('view/msg.php');
        $value = $_POST['msg'];
        ?>
        <script>alert("<?php echo $msg[$value]; ?>");</script>
        <?php
    }else{
    }
?>
</body>
</html>