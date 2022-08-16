<?php

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\OpenApi;

/*Factory qui sert à remplacer celle par défaut afin de pouvoir supprimer de l'api ce qui est désactivié afin que
que les services désactvités ne soient pas consommés par les utilisateurs en rajoutant
'openapi_context'=> ['summary' => 'hidden']*/

class OpenApiFactory implements OpenApiFactoryInterface
{
    public function __construct(private OpenApiFactoryInterface $decorated){
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);
        /** @var PathItem $path */
        foreach ($openApi->getPaths()->getPaths() as $key => $path){
            if($path->getGet() && $path->getGet()->getSummary() == 'hidden'){
                $openApi->getPaths()->addPath($key, $path->withGet(null));
            }
        }

//  Permet de l'utiliser juste pour l'utilisateur

//        $schema = $openApi->getComponents()->getSecuritySchemes();
//        $schema['cookieAuth'] = new \ArrayObject([
//            'type' =>'apiKey',
//            'in' => 'cookie',
//            //nom du cookie de PHP
//            'name' => 'PHPSESSID'
//        ]);
//
//        $schemas= $openApi->getComponents()->getSchemas();
//        $schemas['Credentials'] = new \ArrayObject([
//            'type' => 'object',
//            'properties' => [
//                'username' => [
//                    'type' => 'string',
//                    'example' => 'john@doe.fr',
//                ],
//                'password' => [
//                    'type' => 'string',
//                    'example' => '0000'
//                ]
//            ]
//            ]);
//        $pathItem = new PathItem(
//            post:new Operation(
//                operationId: 'postApilogin',
//                //On peut tagger dans un group à part en remplaçant le contenu du tableau.
//                tags:['User'],
//                requestBody: new RequestBody(
//                    content: new \ArrayObject([
//                        'application/json' => [
//                            'schema' => [
//                                '$ref' => '#/components/schemas/Credentials'
//                            ]
//                        ]
//                    ])
//                ),
//                responses: [
//                    '200' => [
//                        'description' => 'utilisateur connecté',
//                        'content' => [
//                            'application/json' => [
//                                'schema' => [
//                                    '$ref' => '#/components/schemas/User-read.User'
//                                ]
//                            ]
//                        ]
//                    ]
//                ]
//            )
//        );

//        $openApi->getPaths()->addPath('/api/login', $pathItem);

        //permet de verouiller toutes les méthodes si utilisateur anonyme
      $openApi = $openApi->withSecurity(['cookieAuth' => ['']]);

        return $openApi;
    }
}