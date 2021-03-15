<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ],

        'announcement_thumbnail' => [
            'driver' => 'local',
            'root' => storage_path('app/public/announcement_thumbnail'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'event_thumbnail' => [
            'driver' => 'local',
            'root' => storage_path('app/public/event_thumbnail'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'eptparticipant_photoprofile' => [
            'driver' => 'local',
            'root' => storage_path('app/public/eptparticipant_photoprofile'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'staff_photoprofile' => [
            'driver' => 'local',
            'root' => storage_path('app/public/staff_photoprofile'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'adminuser_photoprofile' => [
            'driver' => 'local',
            'root' => storage_path('app/public/adminuser_photoprofile'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'qr-code_participant' => [
            'driver' => 'local',
            'root' => storage_path('app/public/qr-code_participant'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'qr-code_ept' => [
            'driver' => 'local',
            'root' => storage_path('app/public/qr-code_ept'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],

    ],

];
