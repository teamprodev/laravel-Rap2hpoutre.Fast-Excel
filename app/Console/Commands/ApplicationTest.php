<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Services\ApplicationService;
use Illuminate\Console\Command;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class Signers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'application:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Application Test';

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
     * @return void
     */
    public function handle()
    {
        $applications = Application::get()->toArray();
        foreach ($applications as $app) {
            foreach ($app as $key => $value) {
                if (strlen($value) > 32767) {
                    $output = [
                        'id' => $app['id'],
                        'key' => $key,
                        'value' => $value,
                        'length' => strlen($value)
                    ];
                    echo json_encode($output, JSON_PRETTY_PRINT) . "\n";
                }
            }
        }
    }
}
