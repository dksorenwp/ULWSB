<?php
return [
    'webuiPassword' => '$2y$10$RHtzfWqTGErapQ8kYEpMtupnO72mNbXXTIqxCl.b47/8OCMU5h4jq',
    'template' => 'simple',
    'language' => 'en',
    'log' => [
        'enable' => '1',
		'level' => [
                'action' => '1',
                'warning' => '1',
				'error' => '1',
		],
        'local' => '1',
        'localDIR' => '/var/www/html/ULWSB/log',
        'autoDelete' => '14days',
        'webhook' => [
            'discord' => [
                'enable' => '1',
                'embeds' => '1',
                'embedsStyle' => [
					'type' => 'rich',
                    'thumbnail' => 'https://cdn.discordapp.com/embed/avatars/0.png',
                    'authorName' => 'ULWSB',
                    'authorURL' => 'https://github.com/dksorenwp/ULWSB',
                    'authorIcon' => 'https://cdn.discordapp.com/embed/avatars/0.png',
                ],
                'url' => 'https://discordapp.com/api/webhooks/1068608640786911322/B0OYnP4Z9IX11WfK_ayC9DDkXQ8bB5CCd8wAMGU48pUYoU1ZShPcMuGLnuobd7TmmEA2'
            ]
        ]
    ]
];
