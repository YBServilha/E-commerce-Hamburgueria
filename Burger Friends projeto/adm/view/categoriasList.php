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
    <title>Categorias</title>
    <script>
        function confirmDeleteCategoria(id){
            var resp = confirm("Deseja Deletar Categoria?");
            if(resp == true){
                location.href="../controller/controller.php?categoria_delete=1&id=" + id;
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
    <h1>Bem vindo <?php echo $_SESSION['ADM-NOME'] ?> a Área de Categorias!</h1>
    

    <div class="tabela">
        <?php 
            require_once('../model/Menu.class.php'); 
            $mn = new Menu();
            $dados = $mn->ListaTabela("categorias");    
        ?>

        <table>
            <tr>
                <td class="td-addnew">
                <form action="categoriasNew.php">
                    <input class="addnew"  type="submit" name="inserir" value="add categoria">
                </form>
                </td>
            </tr>
        </table>
        <table id="table">
            <?php 
                if(count($dados) == 0){
                    echo "<tr><td>A tabela não possui registros de Categorias</td></tr>";
                }else{
            ?>
            <thead>
                <tr>
                    <th>id</th>
                    <th>categoria</th>
                    <th>nome</th>
                    <th>preco</th>
                    <th>imagem</th>
                    <th>legenda</th>
                    <th>editar</th>
                    <th>deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < count($dados);$i++){
                    echo "<tr>";
                    echo "<td>" .  $dados[$i]['id']  . "</td>";
                    echo "<td>" .  $dados[$i]['categoria']  . "</td>";
                    echo "<td>" .  $dados[$i]['nome']  . "</td>";
                    echo "<td>" .  $dados[$i]['preco']  . "</td>";
                    echo "<td>" .  $dados[$i]['imagem']  . "</td>";
                    echo "<td>" .  $dados[$i]['legenda']  . "</td>";
                    echo "<td>";
                    ?>
                        <form action="categoriasEdit.php" method="POST" name="form">
                            <input type="hidden" name="id" value="<?=$dados[$i]['id']; ?>">
                            <input type="submit" name="destino" value="editar">
                        </form>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <button onclick="confirmDeleteCategoria(<?=$dados[$i]['id'];?>)">deletar</button>
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