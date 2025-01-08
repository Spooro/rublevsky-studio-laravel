<?php

return [
    'temporary_file_upload' => [
        'disk' => 'local',
        'directory' => 'livewire-tmp',
        'middleware' => null,
        'preview_mimes' => [
            'csv' => ['text/csv', 'text/plain'],
        ],
        'max_upload_time' => 5,
    ],
    'class_namespace' => 'App\\Livewire',
    'view_path' => resource_path('views/livewire'),
    'layout' => 'components.layouts.app',
    'asset_url' => null,
    'app_url' => null,
    'middleware_group' => ['web'],
];
