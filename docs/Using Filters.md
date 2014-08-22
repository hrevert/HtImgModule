Using Filters
=========================

## Thumbnail
```php
return [
    'htimg' => [
        'filters' => [
            'my_thumbnail_1' => [  // # Transforms 50x40 to 32x32, while cropping the width
                'type' => 'thumbnail',
                'options' => [
                    'width' => 32,
                    'height' => 32,
                    'mode' => 'outbound '
                ]
            ],
            'my_thumbnail_2' => [  // # Transforms 50x40 to 32x26, no cropping
                'type' => 'thumbnail',
                'options' => [
                    'width' => 32,
                    'height' => 32,
                    'mode' => 'inset'
                ]
            ]            
        ]
    ]
];
```

## Crop
```php
return [
    'htimg' => [
        'filters' => [
            'crop_service' => [ 
                'type' => 'crop',
                'options' => [
                    'width' => 100,
                    'height' => 100,
                    'start' => [200, 200] // Starting co-ordinates like (x, y)
                ]
            ]        
        ]
    ]
];
```

## Resize
```php
return [
    'htimg' => [
        'filters' => [
            'resize_service' => [ 
                'type' => 'resize',
                'options' => [
                    'width' => 100,
                    'height' => 100
                ]
            ]        
        ]
    ]
];
```

## Background
```php
return [
    'htimg' => [
        'filters' => [
            'background' => [ 
                'type' => 'background',
                'options' => [
                    'width' => 100, // optional
                    'height' => 100, // optional
                    'color' => '#fff', // optional
                ]
            ]        
        ]
    ]
];
```

## Chain
With `chain` filter you can apply more than one filter on your image.
```php
return [
    'htimg' => [
        'filters' => [
            'chain' => [ 
                'type' => 'chain',
                'options' => [
                  'filters' => [
                    'crop' => [
                      //crop options goes here
                    ],
                    'watermark' => [
                      //watermark options goes here
                    ],                    
                  ]
                ]
            ]        
        ]
    ]
];
```
## Paste
```php
return [
    'htimg' => [
        'filters' => [
            'paste' => [ 
                'type' => 'paste',
                'options' => [
                  'image' => 'image-to-be-pasted',
                    'x' => 130,
                    'y' => '300'
                ]
            ]        
        ]
    ]
];
```
## Relative Resize
```php
return [
    'htimg' => [
        'filters' => [
            'my_heighten' => [ 
                'type' => 'relative_resize',
                'options' => [
                  'heighten' => 60 # Transforms 50x40 to 75x60
                ]
            ],
            'my_widen' => [ 
                'type' => 'relative_resize',
                'options' => [
                  'widen' => 32 #Transforms 50x40 to 32x26
                ]
            ], 
            'my_increase' => [ 
                'type' => 'relative_resize',
                'options' => [
                  'increase' => 10 # Transforms 50x40 to 60x50
                ]
            ],
            'my_scale' => [ 
                'type' => 'relative_resize',
                'options' => [
                  'scale' => 2.5 # Transforms 50x40 to 125x100
                ]
            ],            
        ]
    ]
];
```
## Watermark
```php
return [
    'htimg' => [
        'filters' => [
            'my_watermark' => [ 
                'type' => 'watermark'',
                'options' => [
                  'watermark' => 'image-to-be-pasted',
                  'size' => '90%', // Optional
                  'position' => 'left' // Optional defaults to center
                ]
            ]        
        ]
    ]
];
```

### Navigation

* Continue to [Displaying Images From Controller](Images From Controller.md)
* Back to [Filters, Filter Loaders And Filter Services](Filters, Filter Loaders And Filter Services.md)
