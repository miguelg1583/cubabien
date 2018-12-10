<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class GeneraImagesGaleria extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imagenes:galeria';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera a partir de las imagenes en "frontend/uploads" los thumbs a 100x100 y 1360x768';

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
        $files = File::files(public_path('frontend/images/uploads'));
        $bar = $this->output->createProgressBar(count($files));
        foreach ($files as $file) {
            $this->info('Comenzando a procesar ' . $file->getFilename());
            getImageThumbnail($file->getFilename(), 100, 100, 'fit');
            $this->line('100x100 Terminado');
            getImageThumbnail($file->getFilename(), 1360, 768, 'fit');
            $this->line('1360x768 Terminado');
            $bar->advance();
        }
        $this->info('Proceso terminado Correctamente, manipuladas ' . count($files).' imagenes');
        $bar->finish();

    }
}
