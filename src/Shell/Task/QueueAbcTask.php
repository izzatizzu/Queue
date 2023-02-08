<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\Log\Log;
use Queue\Shell\Task\QueueTask;
use  Queue\Shell\Task\AddInterface;
use Cake\Core\Exception\Exception;

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
