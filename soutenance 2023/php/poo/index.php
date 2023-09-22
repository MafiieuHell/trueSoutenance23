<?php
use App\Autoloader;
use App\Client\Compte as CompteClient;
use App\Banque\{CompteCourant, CompteEpargne};

require_once 'classes/Autoloader.php';
Autoloader::register();


$compte = new CompteCourant("Mehdi", 500, 200);

$compte->setTitulaire("ilyes");

$compteE = new CompteEpargne("Maman",200,10);

echo"<pre>";
var_dump($compte);
var_dump($compteE);
echo"</pre>";
$compteE->verserInterets();
$compte->retirer(700);
echo"<pre>";
var_dump($compte);

var_dump($compteE);
echo"</pre>";

$client = new CompteClient;
echo"<pre>";
var_dump($client);
echo"</pre>";
