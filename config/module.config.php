<?php
return [
    'htimg' => [],
    'router' => [
        'routes' => [
            'htimg' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/htimg',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'display' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/display/:filter/:relativePath',
                            'defaults' => [
                                'controller' => 'htimg',
                                'action' => 'display'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            'htimg' => 'HtImgModule\Controller\Factory\ImageControllerFactory'
        ]
    ],
    'view_manager' => array(
        'strategies' => array(
            'HtImgModule\View\Strategy\ImageStrategy'
        ),
        'template_map' => array(
             'ht-image/image' => __DIR__ . '/../view/ht-image/image.phtml',
         ),
    ),
];
