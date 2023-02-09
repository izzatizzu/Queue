# CakePHP Queue Plugin
A queue in CakePHP is a method for arranging a task's processing, frequently for performance reasons. A job is added to a queue rather than being executed right away, and the queue is completed by a different worker process. By enabling task execution in the background, resources may be made available for the main process, which enhances the performance of the programme.

CakePHP offers a queue implementation through the CakePHP/Queue package. This package offers a straightforward, dependable, and effective method for managing and carrying out background tasks in CakePHP applications. Worker processes can execute jobs that have been added to the queue locally or on a remote server. This can be beneficial for activities that take a while and slow down the main programme, such as sending emails, processing photos, or creating reports.

## Setup
- Update your Composer

    ```composer update```
  
  
- Installation
  
  ``` composer require dereuromark/cakephp-queue ```

  Load the plugin in bootstrapCli function in src/Application

  ```
  protected function bootstrapCli()
    {
        
        // Existing Code

        $this->addPlugin('Queue');
    }
    ```

- Database migration
 
    Run the following command in the CakePHP console.

  ```bin/cake migrations migrate -p Queue```

## Configuration
  Create a file called ```app_queue.php``` inside your config folder to set some values.

  Example:
  ```
    return [
        'Queue' => [
            'workermaxruntime' => 60,
            'sleeptime' => 15,
        ],
    ];
```

## Queueing Jobs
Run the following command in the CakePHP console.

- Display simple job queue (or deferred-task) system. It contains available tasks and the subcommands to execute.
  
    ``` bin/cake queue```

- Try to call the cli add subcommand on a task.

  ```bin/cake queue add <TaskName>```

- Run a queue worker to execute the pending task.

    ```  bin/cake queue run```
    
## Creating a new Task
You can build your own task and put it in ```/src/Shell/Task/``` as Queue{TaskName}Task.php.

You can set two main things on each task as property: timeout and retries.
```
class QueueAbcTask extends QueueTask implements AddInterface 

{


      /**
     * @var int
     */
    public $timeout = 20;

    /**
     * @var int
     */
    public $retries = 1;
```

### Logging Task

This is the example task of logging an Alphabet character :

```


    public function add(){
        $this->out('CakePHP Queue Example task.');
		$this->hr();
		$this->out('This is a Abc QueueTask.');
		$this->out('I will now add an example Job into the Queue.');
		$this->out('This job will only produce some console output on the worker that it runs on.');
		$this->out(' ');
		$this->out('To run a Worker use:');
		$this->out('    bin/cake queue runworker');
		$this->out(' ');
		$this->out('You can find the sourcecode of this task in: ');
		$this->out(__FILE__);
		$this->out(' ');

		$this->QueuedJobs->createJob('Abc');
		$this->success('OK, job created, now run the worker');
    }
    /**
     * @param array $data The array passed to QueuedJobsTable::createJob()
     * @param int $jobId The id of the QueuedJob entity
     * @return void
     */
    public function run(array $data, $jobId) {
        if (!$this->doLog()) {
            throw new Exception('Couldnt do sth.');
        }
    }

    public function doLog()
    {
        $this->out('Log task started...');
        Log::write('debug', 'Log task started...');

        Log::write('debug', 'A');

        $this->out('Log task completed.');
        Log::write('debug', 'Log task completed.');

        return true;
    }

}
```
You can view the output in ```logs/cli-debug``` file.