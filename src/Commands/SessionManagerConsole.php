<?php
namespace Jetiradoro\SessionManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class SessionManagerConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session-manager:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dependences for session manager component';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // If not exists sessions in database, reconfigure
        if(!Schema::hasTable('sessions')){
            $this->info('Generate Migration');
            $this->call('session:table');
            $this->call('migrate');
            $this->line("================");
        }


        $this->info("Publish assets");
        $this->call("vendor:publish",['--tag'=>'sm-public','--force']);
        $this->line("================");
        $this->info('Modify env attribute session');
        $this->updateDotEnv('SESSION_DRIVER','database');
        $this->info('Modify env attribute session routes');
        $this->updateDotEnv('SM_ROUTES','true');
        $this->line("================");
        $this->comment("...Finished");
    }

    protected function updateDotEnv($key, $newValue, $delim='')
    {

        $path = base_path('.env');
        // get old value from current env
        $oldValue = env($key);

        // was there any change?
        if ($oldValue === $newValue) {
            return;
        }

        // rewrite file content with changed data
        if (file_exists($path)) {

            //determine if add or replace key
            if(strpos(file_get_contents($path),$key)){
                // replace current value with new value
                file_put_contents(
                    $path, str_replace(
                        $key.'='.$delim.$oldValue.$delim,
                        $key.'='.$delim.$newValue.$delim,
                        file_get_contents($path)
                    )
                );
            }else{
                file_put_contents($path,$key.'='.$delim.$newValue.$delim,FILE_APPEND);
            }

        }
    }

}
