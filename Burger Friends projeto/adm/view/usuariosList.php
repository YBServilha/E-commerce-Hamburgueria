<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.menulist.css" rel="stylesheet">
    <title>Usuários</title>
    <script>
        function confirmDeleteUsuario(id){
            var resp = confirm("Deseja Deletar Usuário?");
            if(resp == true){
                location.href="../controller/controller.php?usuario_delete=1&id=" + id;
            }else{
                return null;
            }
        }

        function voltar(){
            location.href="area_administrativa.php";
        }
    </script>
</head>
<body>
    <h1>Bem vindo <?php echo $_SESSION['ADM-NOME'] ?> a Lista de Usuários!</h1>
    

    <div class="tabela">
        <?php 
            require_once('../model/Menu.class.php'); 
            $mn = new Menu();
            $dados = $mn->ListaTabela("usuarios");    
        ?>


        <table id="table">
            <?php 
                if(count($dados) == 0){
                    echo "<tr><td>A tabela não possui registros de Usuários</td></tr>";
                }else{
            ?>
            <thead>
                <tr>
                    <th>id</th>
                    <th>nome</th>
                    <th>endereço</th>
                    <th>complemento</th>
                    <th>número</th>
                    <th>telefône</th>
                    <th>email</th>
                    <th>deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 for($i = 0; $i < count($dados);$i++){
                    echo "<tr>";
                    echo "<td>" .  $dados[$i]['id']  . "</td>";
                    echo "<td>" .  $dados[$i]['nome']  . "</td>";
                    echo "<td>" .  $dados[$i]['endereco']  . "</td>";
                    echo "<td>" .  $dados[$i]['complemento']  . "</td>";
                    echo "<td>" .  $dados[$i]['numero']  . "</td>";
                    echo "<td>" .  $dados[$i]['telefone']  . "</td>";
                    echo "<td>" .  $dados[$i]['email']  . "</td>";
                    echo "<td>";
                    ?>
                    <button onclick="confirmDeleteUsuario(<?=$dados[$i]['id'];?>)">deletar</button>
                    <?php
                    echo "</td>";
                    echo "</tr>";

                } }?>
            </tbody>
        </table><br><br>
            </div>





    <?php 
    //ALERTA DE MENSAGEM
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