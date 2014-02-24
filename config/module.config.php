<?php
return [
    'htimg' => [
        'filters' => [
            'thumbnail' => [
                'type' => 'thumbnail',
                'options' => [
                    'width' => 100,
                    'height' => 100,
                ]
            ]
        ]
    ],
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
                            'route' => '/display/:filter/',
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
    ),
];
