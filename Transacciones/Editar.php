<?php

date_default_timezone_set('America/Santo_Domingo');
require_once '../Layout/Layout.php';
require_once '../Helpers/Utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/SerializationFileHandler.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../FileHandler/CSVFileHandler.php';
require_once '../FileHandler/LogFileHandler.php';
require_once 'ServiceSession.php';
require_once 'ServiceCookies.php';
require_once 'ServiceFile.php';
require_once 'Transactions.php';

$isRoot= false;
$SemiRoot = ($isRoot) ? "Transacciones/" : "";
$Directory = "{$SemiRoot}data";
$filename = "Log";
$Log = new LogFileHandler
($Directory,$filename);

$Service = new ServiceFile();
$Layout = new Layout();
$Utilities = new Utilities();

$Transaccion = null;

if (isset($_GET["id"])) {

    $Transaccion = $Service->GetById($_GET["id"]);
}

if(isset($_POST["Monto"]) && isset($_POST["Descripcion"]) && isset($_POST["Fecha"])){

    $Transactions = new Transactions($_POST["TransaccionId"],$_POST["Monto"],$_POST["Descripcion"],$_POST["Fecha"]);

    $Service->Edit($Transactions);
    $Time = date('d-m-Y');
    $Hour = date('(h:i a)');
    $LogList = $Log->ReadFile();
    $NewLog = 'En la fecha ' . $Time . ' a las '. $Hour . ', se editó la transacción de ID: ' . $Transactions->Id . PHP_EOL;

    if ($LogList !== FALSE) {

        $LogList .= $NewLog;

        $Log->SaveFile($LogList);

    } else {
        $Log->SaveFile($NewLog);
    }
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>
    <?php echo $Layout->printHeader() ?>

    <?php if ($Transaccion == null) : ?>

        <h2>No existe esta transacción</h2>

    <?php else : ?>
        
        <div class="modal-dialog shadows">
        <div class="modal-content margin-top-30">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="NuevaPelisLabel">Editar Transacción</h5>
            </div>

            <div class="modal-body">
                <form action="Editar.php" method="POST">
                    <input type="hidden" name="TransaccionId" value="<?= $Transaccion->Id ?>">
                
                    <div class="mb-3">
                        <label for="Monto" class="form-label">Monto</label>
                        <input name="Monto" value="<?php echo $Transaccion->Monto ?>" type="text" class="form-control" id="Monto">
                    </div>

                    <div class="mb-3">
                        <label for="Fecha" class="form-label" style="display:none">Fecha</label>
                        <input name="Fecha" type="text" style="display:none" class="form-control" value="<?= date('d-m-Y (h:i a)') ?>" id="Fecha">
                    </div>

                    <div class="mb-3">
                        <label for="Descripcion" class="form-label">Descripción</label>
                        <input name="Descripcion" value="<?php echo $Transaccion->Descripcion ?>" type="text" class="form-control" id="Descripcion">
                    </div>

                    <button type="submit" class="btn btn-success float-end margin-left-1">Guardar</button>
                    <a href="../index.php" class="btn btn-dark float-end margin-left-1">Volver atras</a>
                </form>
            </div>
        </div>
    </div>

    <?php endif; ?>
   
    <?php echo $Layout->printFooter() ?>

</body>
</html>