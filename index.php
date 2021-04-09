<?php

require_once 'Transacciones/Transactions.php';
require_once 'FileHandler/IFileHandler.php';
require_once 'FileHandler/FileHandlerBase.php';
require_once 'FileHandler/SerializationFileHandler.php';
require_once 'FileHandler/JsonFileHandler.php';
require_once 'FileHandler/CSVFileHandler.php';
require_once 'FileHandler/LogFileHandler.php';
require_once 'Helpers/Utilities.php';
require_once 'Transacciones/ServiceSession.php';
require_once 'Transacciones/ServiceCookies.php';
require_once 'Transacciones/ServiceFile.php';
require_once 'layout/layout.php';

$Layout = new Layout(true);
$Service = new ServiceFile(true);
$Utilities = new Utilities();

$Transactions = $Service->GetList();

?>

<?php echo $Layout->printHeader(); ?>

<div class="row">
    <section class="jumbotron text-center">
            <h1>Registro de transacciones <button type="button" class="btn btn-success margin-left-34" data-bs-toggle="modal" data-bs-target="#nuevo-heroe-modal">Agregar Transacción</button></h1>
            <div class="margin-bottom-5"></div>
    </section>
</div>

<table class="table table-striped">
<thead class="bg-success text-white">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Fecha y Hora</th>
      <th scope="col">Monto</th>
      <th scope="col">Descripción</th>
      <th scope="col"></th>   
    </tr>
  </thead>

    <?php if (count($Transactions) == 0) : ?>

        <h2>No hay transacciones registradas</h2>
        <div class="margin-bottom-2"></div>

    <?php else : ?>

        <?php foreach ($Transactions as $key => $Transaction) : ?>
            <tbody>
                <tr>
                    <th scope="row"><?= $Transaction->Id ?></th>
                    <td><?= $Transaction->Fecha ?> </td>
                    <td>$<?= $Transaction->Monto ?></td>
                    <td><?= $Transaction->Descripcion ?></td>
                    <td><a href="Transacciones/Editar.php?id=<?= $Transaction->Id ?>" class="btn btn-primary">Editar</a>
                    <a href="#" data-id="<?= $Transaction->Id ?>" class="btn btn-danger btn-delete">Eliminar</a></td>
                </tr>
            </tbody>

        <?php endforeach; ?>

    <?php endif; ?>

</table>

<div class="modal fade" id="nuevo-heroe-modal" tabindex="-1" aria-labelledby="nuevoHeroeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="shadows">
        <div class="modal-content margin-top-20">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="nuevoHeroeLabel">Datos de la transacción</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form action="Transacciones/Agregar.php" method="POST">

                    <div class="mb-3">
                        <label for="Monto" class="form-label">Monto</label>
                        <input name="Monto" type="text" class="form-control" id="Monto">
                    </div>

                    <div class="mb-3">
                        <label for="Fecha" class="form-label" style="display:none">Fecha</label>
                        <input name="Fecha" type="text" style="display:none" class="form-control" value="<?= date('d-m-Y H:i:s') ?>" id="Fecha">
                    </div>

                    <div class="mb-3">
                        <label for="Descripcion" class="form-label">Descripción</label>
                        <input name="Descripcion" type="text" class="form-control" id="Descripcion">
                    </div>

                <button type="submit" class="btn btn-success float-end margin-left-1">Guardar</button>
                <button type="button" class="btn btn-dark float-end margin-left-1" data-bs-dismiss="modal">Cerrar</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

<?php echo $Layout->printFooter(); ?>

<script src="assets/JavaScript/site/index/index.js"></script>