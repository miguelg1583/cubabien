<?php

namespace App\Console\Commands;

use DB;
use File;
use Illuminate\Console\Command;
use Spatie\TranslationLoader\LanguageLine;

class TraduceArchivo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'traduce:archivo {file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capta los value de determinado archivo y los inserta en la tabla de traducciones si no estan, solo "ES" y "EN"';

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
        try {
            $this->info('Comenzando a procesar...');

            $path_en = base_path() . '/resources/lang/en/';
            $path_es = base_path() . '/resources/lang/es/';

            $l_group = $this->argument('file_name');

            if (File::exists($path_en . $this->argument('file_name') . '.php') && File::exists($path_es . $this->argument('file_name') . '.php')) {
                $this->info('Encontrado "' . $path_en . $this->argument('file_name') . '.php' . '"');
                $this->info('Encontrado "' . $path_es . $this->argument('file_name') . '.php' . '"');

                $this->info('Chequeando Valores del arreglo');

                $arr_en = File::getRequire($path_en . $this->argument('file_name') . '.php');
                $arr_es = File::getRequire($path_es . $this->argument('file_name') . '.php');

                if (count(array_diff_key($arr_en, $arr_es)) === 0) {
                    $this->info('Valores Correctos');

                    $bar = $this->output->createProgressBar(count($arr_en));
                    foreach ($arr_en as $key => $value) {
                        $bar->advance();
                        if (count(DB::table('language_lines')->whereRaw('CONCAT_WS(".",`group`,`key`)=?', [$l_group . '.' . $key])->get()) === 0) {
                            //inserto en table
                            LanguageLine::create([
                                'group' => $l_group,
                                'key' => $key,
                                'text' => array_combine(["es", "en"], [$arr_es[$key], $value]),
                            ]);
                        } else {
                            $this->info('"' . $l_group . '.' . $key . '"ya existe en la base de datos');
                        }
                    }
                    $bar->finish();
                } else {
                    $this->error('Las Llaves de los ficheros no coinciden');
                }
            } else {
                $this->error('Error, no existen los archivos requeridos');
            }

        } catch (\Exception $e) {
            report($e);
            $this->error('Error, revise los logs: ' . $e->getMessage());
        }
    }
}
