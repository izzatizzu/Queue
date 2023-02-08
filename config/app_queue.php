<?php
return [
    'Queue' => [
        'workermaxruntime' => 60,
        'sleeptime' => 15,

            // A DSN for your configured backend. default: null
        // Can contain protocol/port/username/password or be null if the backend defaults to localhost
        'url' => 'redis://myusername:mypassword@example.com:1000',

        // The queue that will be used for sending messages. default: default
        // This can be overridden when queuing or processing messages
        'queue' => 'default',

        // The name of a configured logger, default: null
        'logger' => 'stdout',

        // The name of an event listener class to associate with the worker
        'listener' => \App\Listener\WorkerListener::class,

        // The amount of time in milliseconds to sleep if no jobs are currently available. default: 10000
        'receiveTimeout' => 10000,

        // Whether to store failed jobs in the queue_failed_jobs table. default: false
        'storeFailedJobs' => true,

        // (optional) The cache configuration for storing unique job ids. `duration`
        // should be greater than the maximum length of time any job can be expected
        // to remain on the queue. Otherwise, duplicate jobs may be
        // possible. Defaults to +24 hours. Note that `File` engine is only suitable
        // for local development.
        // See https://book.cakephp.org/4/en/core-libraries/caching.html#configuring-cache-engines.
        'uniqueCache' => [
            'engine' => 'File',

       
    ],
    ]
];