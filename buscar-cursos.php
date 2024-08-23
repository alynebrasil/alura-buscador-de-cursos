<?php
require 'vendor/autoload.php';

Teste::teste();
exit();

use Alyne\BuscadorDeCursos\BuscadorDeCursos;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

//URL ou domínio base da qual serão feitas requisições pelo código
$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

// Um buscador que recebe um client e um crawler
$buscador = new BuscadorDeCursos($client, $crawler);
// Chamado o método buscar para fazer uma requisição com a url dos cursos que queremos buscar
$cursos = $buscador->buscar('/cursos-online-programacao/php');

foreach($cursos as $curso){
   echo $curso . PHP_EOL;
}