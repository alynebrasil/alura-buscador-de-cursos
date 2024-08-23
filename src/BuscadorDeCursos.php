<?php

namespace Alyne\BuscadorDeCursos;
use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class BuscadorDeCursos
{

    /**
     * 
     * @var ClientInterface $httpClient
     */
    private $httpClient;
    /**
     * 
     * @var Crawler $crawler
     */
    private $crawler;

    //Vai receber um client HTTP e um crawler
    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    // Vai receber uma url e devolver uma array de cursos
    public function buscar(string $url) : array
    {
        $resposta = $this->httpClient->request('GET', $url);

        // Assim é melhor pois não vamos precisar do HTML inteiro, apenas de alguns elementos dele
        $html = $resposta->getBody();
        $this->crawler->addHtmlContent($html);

        $elementosCursos =  $this->crawler->filter(selector:'span.card-curso__nome');

        $cursos = [];

        foreach($elementosCursos as $elementoCurso){
            $cursos[] = $elementoCurso->textContent;
        }

         return $cursos;
    }
}