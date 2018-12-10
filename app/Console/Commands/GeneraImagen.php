<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GeneraImagen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imagenes:generar {image} {width} {height} {type=fit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera imagen dada con resolucion a demanda';

//    protected $image, $width, $height, $type;

    /**
     * Create a new command instance.
     *
     *
     */
//    public function __construct($image, $width, $height, $type)
    public function __construct()
    {
        parent::__construct();
//        $this->image=$image;
//        $this->width=$width;
//        $this->height=$height;
//        $this->type=$type;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Comenzando a procesar...');
        $url=getImageThumbnail($this->argument('image'),$this->argument('width'),$this->argument('height'),$this->argument('type'));
        $this->info('Proceso terminado Correctamente');
        $this->info($url);
    }
}
