<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("location: login.php");
}

include("conn.php");
$idVeiculo = $_GET["idVeiculo"] ?? 0;
$sql = "SELECT e.id, e.placa, c.cor, e.dt_entrada
FROM estacionamento AS e
INNER JOIN cores AS c ON e.cor_id = c.id
WHERE e.id = $idVeiculo";

$result = $conn->query($sql);
$linha = $result->fetch_assoc();

$data_inicial = new DateTime($linha["dt_entrada"]);
$data_saida = new DateTime();

$intervalo = $data_saida->diff($data_inicial);
$dias = $intervalo->days;
$horas = $intervalo->h;
$minutos = $intervalo->i;

$valorinicial = 10;
$valoradicional = 2;
$valordiaria = 80;
$valorPagar = 0;

if( $dias > 0) {
    $valorPagar = $dias * $valordiaria;
}else{
    if($minutos <=20 && $horas == 0) {
        $valorPagar = 0;
    }else if($horas < 3 || ($minutos == 0 && $horas == 3)) {
        $valorPagar = $valorinicial;
    }else{
        $horasAdd = ceil(((($horas * 60) - 180 ) + $minutos) / 60);
        $valorPagar = ($horasAdd * $valoradicional) + $valorinicial;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Estacionamento Senac</title>
    <?php include("estrutura/import_css.php") ?>

</head>

<body id="page-top">
    <?php include_once("./estrutura/menu.php"); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Estacionamento Senac - Saída de veiculos</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Gerar Relatório</a>
        </div>


        <form action="efetuar_saida.php" class="p-5" method="get">
            <div class="d-flex flex-column flex-lg-row gap-4 ">
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">ID</label>
                    <input type="text" class="form-control"
                        value="<?= $linha["id"] ?>" name="id" readonly>
                </div>
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Placa</label>
                    <input type="text" class="form-control" value="<?= $linha["placa"] ?>" name="placa" readonly>
                </div>
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Cor</label>
                    <input type="text" class="form-control"
                        value="<?= $linha["cor"] ?>" name="cor" readonly>
                </div>
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Data_Hora Entrada</label>
                    <input type="datetime-local" class="form-control" name="dt_entrada"
                        value="<?= $linha["dt_entrada"] ?>" readonly>
                </div>
            </div>

            <div class="d-flex flex-column flex-lg-row gap-4 ">
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Data_Hora Saída</label>
                    <input type="datetime-local" class="form-control" name="dt_saida"
                        value="<?= $data_saida->format("Y-m-d H:i") ?>">
                </div>
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Valor a pagar</label>
                    <input type="text" class="form-control"
                        value="<?= "R$ " . number_format($valorPagar, 2, ',', '.') ?>" name="valor">
                </div>
                <div class="mb-3 flex-grow-1">
                    <label class="form-label">Tipo de pagamento</label>
                    <Select class="form-select" name="tipo_pgto">
                        <?php
                        $result = $conn->query("SELECT * FROM tipospg");
                        while ($linha = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $linha["id"] ?>"><?= $linha["tipo"] ?></option>
                        <?php
                        }
                        ?>
                    </Select>
                </div>
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Observações</label>
                    <textarea name="observacoes" id="" cols="30" rows="5"
                        class="form-control"></textarea>
                </div>
            </div>

            <div class="d-flex gap-4 flex-row-reverse mt-3 ">
                <button type="submit" class="btn btn-warning">Efetuar Saída</button>
            </div>
        </form>



    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php include_once("./estrutura/footer.php"); ?>

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sair</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Sair do sistema?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
                    <a class="btn btn-dark" href="login.html">Sim</a>
                </div>
            </div>
        </div>
    </div>


    <?php include("estrutura/import_js.php") ?>
</body>

</html>