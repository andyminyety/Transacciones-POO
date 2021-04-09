<?php

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

    $Id = isset($_GET["id"]);

    $Transactions = $Service->GetById($_GET["id"]);
   
    if($Id){

        $Service->Delete($_GET["id"]);
        
        $Time = date('d-m-Y');
        $Hour = date('(h:i a)');
        $LogList = $Log->ReadFile();
        $NewLog = 'En la fecha ' . $Time . ' a las '. $Hour . ', se eliminó la transacción de ID: ' . $Transactions->Id . PHP_EOL;
    
        if ($LogList !== FALSE) {
    
            $LogList .= $NewLog;
            $Log->SaveFile($LogList);

        } else {
            $Log->SaveFile($NewLog);
        }
    }

    header("Location: ../index.php");
    exit();
?>