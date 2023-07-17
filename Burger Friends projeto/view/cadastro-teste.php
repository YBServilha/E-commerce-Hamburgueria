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
    <title>Burger Friends - Cadastro</title>
    <link rel="stylesheet" href="css/cadastro1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;800&family=Rubik+Dirt&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Cabeçalho/Menu-->
  <nav id="navbar"class="navbar navbar-expand-lg navbar-light bg-dark">
      <a class="navbar-brand col-5" href="../index.php"><img src="img/logo1.png" alt="Logo" id="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <?php 
            require_once("../model/Manager.php");
            $manager = new Manager();
            $dados = $manager->pegaMenusSubmenus("v");

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
            </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="../index.php#quem-somos">Sobre <span class="sr-only">(Página atual)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="../index.php#localizacao">Localização</a>
          </li>

        </ul>
      </div>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link mr-2 mt-1" id="login" href="login.php">LogIn <span class="sr-only">(Página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-5 mt-1" id="signin" href="cadastro-teste.php">SignIn <span class="sr-only">(Página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="carrinho.php"><ion-icon name="cart-outline" id="icon-carrinho" class="text-light"></ion-icon><span class="sr-only">(Página atual)</span></a>
            </li>
            <?php if(isset($_SESSION['USER-ID'])){ ?>
            <li class="nav-item">
              <a class="nav-link mr-2 mt-1" id="Logout" href="logout.php">Logout<span class="sr-only">(Página atual)</span></a>
            </li>
            <?php } ?>

          </ul>
        </div>
    </nav>

      <!-- FIM Cabeçalho/Menu-->
    <section class="cadastro">
        <div class="texto-imagem">
            <p>Faça cadastro</p>
            <p>E peça já seu lanche</p>

            <img src="img/hamburger-animate.svg" class="img-hamburguer" alt="Hambuger animação">
        </div>
        <div class="formulario">
            <div class="box-formulario">
                <h2>Cadastro</h2>
                <form action="../controller/controller.php" method="POST">
                    <input type="hidden" name="usuario_new">
                    <input type="text" name="nome" placeholder="Nome...">

                <div class="input-dois">
                    <input type="text" name="endereco" placeholder="Endereço...">
                    <input type="text" name="complemento" placeholder="Complemento...">
                    <input type="text" name="numero" placeholder="Número...">
                </div>
                <input type="text" name="telefone" placeholder="Telefone...">

                <div class="input-dois">
                    <input type="email" name="email" placeholder="E-mail...">
                    <input type="password" name="senha" placeholder="Senha...">
                </div>

                <input type="submit" id="botao-enviar" value="Cadastrar">
                </form>
            </div>
        </div>
    </section>
<!-- Footer -->
<footer class="bg-dark">
    <div class="logo-rodape"><img src="img/logo1.png" alt="Logo"></div>
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
</body>
</html>