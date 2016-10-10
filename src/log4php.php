<?php
return [
    'rootLogger' => [
        'level' => 'INFO',
        'appenders' => ['default']
    ],
    'appenders' => [
        'default' => [
            'class' => 'LoggerAppenderDailyFile',
            'layout' => [
                'class' => 'LoggerLayoutPattern',
                'params' => ['conversionPattern' => '%d{Y-m-d H:i:s u} [%pid] [%p] %c: %m (at %F line %L)%n']
            ],
            'params' => [
                'datePattern' => 'Ymd',
                'file' => ROOT_APPLICATION_PATH . '/logs/log_%s.log'
            ]
        ]
    ]
];
