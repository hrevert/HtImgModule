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
                            'route' => '/:filter/:relativePath',
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
    ]
];
