<?php

namespace Drupal\lista_post\Controller;

use Drupal\user\UserInterface;
use GuzzleHttp\ClientInterface;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PostController extends ControllerBase{
    protected $httpClient;

    /**
     * {@inheritdoc}
     */
    public function __construct(ClientInterface $http_client) {
      $this->httpClient = $http_client;
    }
    public static function create(ContainerInterface $container) {
        return new static(
          $container->get('http_client')
        );
      }
    public function listar()
    {
        $request = $this->httpClient->request('GET', 'https://jsonplaceholder.typicode.com/posts/', ['verify' => false]);
        
        $posts = Json::decode($request->getBody()->getContents());
     /** @var \GuzzleHttp\Client $client */
     
    
      foreach ($posts as $post) {
        $filas[]=[
            'data' => [
                'id' => $post['id'],
                'title' => $post['title'],
                'body' => $post['body'],

            ], 
        ];
    }
    /*------------------------------------
    #imprimir la tabla desde el controlador 
    --------------------------------------*/

    /*
    $cabeceras=[
        'ID',
        'Titulo',
        'Contenido',

    ];
    $tabla= [
        '#type' => 'table',
        '#header' => $cabeceras,
        '#rows' => $filas
      ];
    $build[] = $tabla;
     return $build;

   */

    /*----------------------------------------
    #imprimir la tabla desde el un template twig 
    ------------------------------------------*/

    return array(
      '#theme' => 'lista_post',
      '#titulo' => 'Listado de Posts',
      '#posts' => $filas          
  );

    }  
}
