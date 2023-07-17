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
    <link href="css/style.admlist.css" rel="stylesheet">
    
    <title>admList</title>
    <script>
        function confirmDelete(id){
            var resp = confirm("Deseja Deletar administrador?");
            if(resp == true){
                location.href="../controller/controller.php?adm_delete=1&id=" + id;
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
    <h1>Bem vindo <?php echo $_SESSION['ADM-NOME'] ?> a Lista de administradores!</h1>

    <div class="caixa-tabela">
        <?php 
            require_once('../model/Manager.php'); 
            $man = new Manager();
            $dados = $man->ListAdm();
            
        ?>
        <table>
            <tr>
                <td class="td-add">
                    <form action="admNew.php" method="POST" name="form">
                        <input type="submit" class="sbmt" name="sbmt" value="add">
                    </form>
                </td>
            </tr>
        </table>
        <table id="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nome</th>
                    <th>email</th>
                    <th>datahora</th>
                    <th>poder</th>
                    <th>status</th>
                    <th>editar</th>
                    <th>deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 1; $i <= $dados['num'];$i++){
                    echo "<tr>";
                    echo "<td>" .  $dados[$i]['id']  . "</td>";
                    echo "<td>" .  $dados[$i]['nome']  . "</td>";
                    echo "<td>" .  $dados[$i]['email']  . "</td>";
                    echo "<td>" .  $dados[$i]['datahora']  . "</td>";
                    echo "<td>" .  $dados[$i]['poder']  . "</td>";
                    echo "<td>";
                    if($dados[$i]['status'] == 1){
                        echo "Ativo";
                    }else{
                        echo "Inativo";
                    }
                    echo"</td>";
                    echo "<td>";
                    ?>
                        <form action="admEdit.php" method="POST" name="form">
                            <input type="hidden" name="id" value="<?=$dados[$i]['id']; ?>">
                            <input type="submit" name="editar" value="editar">
                        </form>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <button onclick="confirmDelete(<?=$dados[$i]['id'];?>)">deletar</button>
                    <?php
                    echo "</td>";
                    echo "</tr>";

                } ?>
            </tbody>

        </table>
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