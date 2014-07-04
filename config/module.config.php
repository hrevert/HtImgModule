<?php
return [
    'htimg' => [
        'filters' => [ // Just one for quick and easy way
            'thumbnail' => [
                'type'      => 'thumbnail',
                'options'   => [
                    'width'     => 100,
                    'height'    => 100,
                ]
            ]
        ],
        'image_resolvers' => [
            1000    => 'image_map',
            200     => 'image_path_stack',
        ],
        'resolvers_manager' => [],
        'loaders' => [],
    ],
    'router' => [
        'routes' => [
            'htimg' => [
                'type'      => 'Literal',
                'options'   => [
                    'route' => '/htimg',
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'display'   => [
                        'type' => 'Segment',
                        'options' => [
                            'route'     => '/display/:filter/',
                            'defaults'  => [
                                'controller'    => 'htimg',
                                'action'        => 'display'
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
    'view_manager' => [
        'strategies' => [
            'HtImgModule\View\Strategy\ImageStrategy',
        ],
    ],
];
