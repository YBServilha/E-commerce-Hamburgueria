<?php 
    session_start();

    if(!isset($_SESSION['ADM-EMAIL'])){
        session_destroy();
        ?>
            <form action="../index.php" method="POST" name="myForm" id="Form">
                <input type="hidden" name="msg" value="MI01">
            </form>
            <script>document.getElementById("Form").submit();</script>
        <?php
    }else{
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.menulist.css" rel="stylesheet">
    <title>admList</title>
    <script>
        function confirmDeleteMenu(id){
            var resp = confirm("Deseja Deletar menu?");
            if(resp == true){
                location.href="../controller/controller.php?menu_delete=1&id=" + id;
            }else{
                return null;
            }
        }
        function confirmDeleteSubmenu(id){
            var resp = confirm("Deseja Deletar submenu?");
            if(resp == true){
                location.href="../controller/controller.php?submenu_delete=1&id=" + id;
            }else{
                return null;
            }
        }

        function voltar(){
            location.href="area_administrativa.php";
        }
    </script>
    <style>
    </style>
</head>
<body>
    <h1>Bem vindo <?php echo $_SESSION['ADM-NOME'] ?> a área de Menu & Submenu!</h1>

    <!--INÍCIO TABELA MENU-->
    <div class="tabela">
        <?php 
            require_once('../model/Menu.class.php'); 
            $mn = new Menu();
            $dados = $mn->ListaTabela("menu");    
        ?>

        <table>
            <tr>
                <td class="td-addnew">
                    <form action="menuNew.php" method="POST" name="form">
                        <input type="hidden" name="menu" value="menu">
                        <input class="addnew" type="submit" name="sbmt" value="add Menu">
                    </form>
                </td>
            </tr>
        </table>
        <table id="table">
            <?php 
                if(count($dados) == 0){
                    echo "<tr><td>A tabela não possui registros de Menu</td></tr>";
                }else{
            ?>
            <thead>
                <tr>
                    <th>id</th>
                    <th>folder</th>
                    <th>nome</th>
                    <th>url</th>
                    <th>data</th>
                    <th>status</th>
                    <th>editar</th>
                    <th>deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < count($dados);$i++){
                    echo "<tr>";
                    echo "<td>" .  $dados[$i]['id']  . "</td>";
                    echo "<td>" .  $dados[$i]['folder']  . "</td>";
                    echo "<td>" .  $dados[$i]['nome']  . "</td>";
                    echo "<td>" .  $dados[$i]['url']  . "</td>";
                    echo "<td>" .  $dados[$i]['datahora']  . "</td>";
                    echo "<td>";
                    if($dados[$i]['status'] == 1){
                        echo "Ativo";
                    }else{
                        echo "Inativo";
                    }
                    echo"</td>";
                    echo "<td>";
                    ?>
                        <form action="menuEdit.php" method="POST" name="form">
                            <input type="hidden" name="id" value="<?=$dados[$i]['id']; ?>">
                            <input type="submit" name="destino" value="menuedit">
                        </form>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <button onclick="confirmDeleteMenu(<?=$dados[$i]['id'];?>)">deletar</button>
                    <?php
                    echo "</td>";
                    echo "</tr>";

                } }?>
            </tbody>
        </table><br><br>
            </div>
        <!--FIM TABELA MENU-->

        <!--INÍCIO TABELA SUBMENU-->
        <div class="tabela">
        <?php 
            require_once('../model/Menu.class.php'); 
            $mn = new Menu();
            $sdados = $mn->ListaTabela("submenu");    
        ?>
        <table>
            <tr>
                <td class="td-addnew">
                    <form action="menuNew.php" method="POST" name="form">
                        <input type="hidden" name="submenu" value="menu">
                        <input class="addnew" type="submit" name="sbmt" value="add Submenu">
                    </form>
                </td>
            </tr>
        </table>
        <table id="table">
            <?php 
                if(count($sdados) == 0){
                    echo "<tr><td>A tabela não possui registros de Submenu</td></tr>";
                }else{
            ?>
            
            <thead>
                <tr>
                    <th>id</th>
                    <th>folder</th>
                    <th>id menu</th>
                    <th>nome submenu</th>
                    <th>url</th>
                    <th>data</th>
                    <th>status</th>
                    <th>editar</th>
                    <th>deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < count($sdados);$i++){
                    echo "<tr>";
                    echo "<td>" .  $sdados[$i]['id']  . "</td>";
                    echo "<td>" .  $sdados[$i]['folder']  . "</td>";
                    echo "<td>" .  $sdados[$i]['idmenu']  . "</td>";
                    echo "<td>" .  $sdados[$i]['nomesub']  . "</td>";
                    echo "<td>" .  $sdados[$i]['url']  . "</td>";
                    echo "<td>" .  $sdados[$i]['datahora']  . "</td>";
                    echo "<td>";
                    if($sdados[$i]['status'] == 1){
                        echo "Ativo";
                    }else{
                        echo "Inativo";
                    }
                    echo"</td>";
                    echo "<td>";
                    ?>
                        <form action="menuEdit.php" method="POST" name="form">
                            <input type="hidden" name="id" value="<?=$sdados[$i]['id']; ?>">
                            <input type="submit" name="destino" value="submenuedit">
                        </form>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <button onclick="confirmDeleteSubmenu(<?=$sdados[$i]['id'];?>)">deletar</button>
                    <?php
                    echo "</td>";
                    echo "</tr>";

                }} ?>
            </tbody>
        </table>
        <!--FIM TABELA SUBMENU-->
    </div>
    <?php
    if(isset($_POST['msg'])){
        include_once('msg.php');
        $value = $_POST['msg'];
        ?>
        <script>alert("<?php echo $msg[$value]; ?>");</script>
        <?php
    }else{
    }
    ?>
</body>
</html>