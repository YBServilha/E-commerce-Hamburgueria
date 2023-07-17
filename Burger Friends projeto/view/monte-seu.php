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
    <title>Produto - Burger Friends</title>
    <link rel="stylesheet" href="css/monte-seu1.css">
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


    <!-- Monte o seu -->


    <div class="container-monte-seu">
      <h2 class="rubik">Monte o seu!</h2>
        <div class="form-hamburguer">
            <form action="produto.php" method="POST">
              <input type="hidden" name="monte_seu">
                <fieldset>
                   <legend class="rubik">Primeiro escolha o pão</legend>

                   <label>
                        <input required id="input1" type="radio" name="pao" value="tradicional" onclick="paoTradicional();" /><span>Tradicional</span>
                    </label>
                    <label>
                        <input id="input2" type="radio" name="pao" value="brioche" onclick="paoTradicional();"/><span>Brioche</span>
                    </label>
                    <label>
                        <input id="input3" type="radio" name="pao" value="australiano" onclick="paoTradicional();"/><span>Australiano</span>
                    </label>
                </fieldset>

                <fieldset>
                    <legend class="rubik">Agora o tipo da carne</legend>
 
                    <label>
                         <input required type="radio" name="burger" value="bovino"/><span>Bovino</span>
                     </label>
                     <label>
                         <input type="radio" name="burger" value="vegetariano"/><span>Vegetariano</span>
                     </label>
                 </fieldset>


                 <fieldset>
                  <legend class="rubik">Tipo do queijo</legend>

                  <label>
                       <input type="radio" name="queijo" value="muçarela" id="inputQueijo1" onclick="queijo();"/><span>Muçarela</span>
                   </label>
                   <label>
                       <input type="radio" name="queijo" value="cheddar" id="inputQueijo2" onclick="queijo();"/><span>Cheddar</span>
                   </label>
                   <label>
                    <input type="radio" name="queijo" value="prato" id="inputQueijo3" onclick="queijo();"/><span>Prato</span>
                </label>
               </fieldset>

                 <fieldset>
                  <legend class="rubik">Ponto da carne</legend>

                  <label>
                       <input required type="radio" name="ponto" value="mal passada"/><span>Mal passado</span>
                   </label>
                   <label>
                       <input type="radio" name="ponto" value="ao ponto"/><span>Ao ponto</span>
                   </label>
                   <label>
                    <input type="radio" name="ponto" value="bem passada"/><span>Bem passado</span>
                </label>
               </fieldset>


               <fieldset>
                <legend class="rubik">Adicionais:</legend>

                <label>
                     <input type="checkbox" name="alface" value="Alface"/><span>Alface</span>
                 </label>
                 <label>
                     <input type="checkbox" name="bacon" value="Bacon"/><span>Bacon</span>
                 </label>
                 <label>
                  <input type="checkbox" name="tomate" value="Tomate"/><span>Tomate</span>
              </label>
              <label>
                <input type="checkbox" name="cebola" value="Cebola frita"/><span>Cebola Frita</span>
            </label>
            <label>
              <input type="checkbox" name="picles" value="picles"/><span>Picles</span>
          </label>
          <label>
            <input type="checkbox" name="pimenta" value="pimenta"/><span>Pimenta</span>
        </label>
             </fieldset>

             
             <input type="submit" class="finalizar" value="finalizar">
             </form>
        </div>
    </div>
     <!-- Footer -->
  <footer class="bg-dark">
    <div class="logo-rodape"><img src="img/logo1.png" alt="Logo"></div>
    <p class="text-light">Burger Friends - Todos os direitos reservados &copy2022</p>
    <div class="redes-sociais">
    <h2>Siga em nossas redes sociais:<a href="https://www.facebook.com/profile.php?id=100088285543880" target="_blank"><ion-icon name="logo-facebook" class="first-icon-footer"></a><a href="https://www.instagram.com/_burger_friends/" target="_blank"></ion-icon><ion-icon name="logo-instagram"></ion-icon></a></h2>
    </div>
  </footer>
<!-- FIM Footer -->

<script>

    function paoTradicional(){
        var img = document.getElementById('pao');
        var imgVazia = "none";
        var input1 = document.getElementById('input1');
        var input2 = document.getElementById('input2');
        var input3 = document.getElementById('input3');


            if(input1.checked == true){
                img.style.display = "block";
                img.src = "img/MonteSeu/img/Desenho/pão-1.png";
            }else if(input2.checked == true){
                img.style.display = imgVazia;
                
            } else if(input3.checked == true){
                img.style.display = imgVazia;
            }
    }

    function queijo(){
        var img = document.getElementById('queijo');
        var imgVazia = "none";
        var input1 = document.getElementById('inputQueijo1');
        var input2 = document.getElementById('inputQueijo2');
        var input3 = document.getElementById('inputQueijo3');

        if(input1.checked == true){
          img.style.display = "block";
          img.src = "img/MonteSeu/img/Desenho/queijo-1.png";
          console.log('Input 1');
        }else if(input2.checked == true){
          img.style.display = imgVazia;
          console.log('Input 2');
        } else if(input3.checked == true){
          img.style.display = imgVazia;
          console.log('Input 3');
        }
    }

</script>



    <!-- FIM Monte o seu -->








<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>