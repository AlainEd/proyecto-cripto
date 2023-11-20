<?php

namespace App\Livewire\Transposicion;

use Livewire\Component;

class Serie extends Component
{
    public $mensajeSinCifrar;
    public $claveSerieSinCifrar;

    public $mensajeCifrado;
    public $claveSerieCifrado;

    public $mensajeCifradoResultado;
    public $mensajeDescifradoResultado;  

    protected $rulesSinCifrar = [
        'mensajeSinCifrar' => 'required',
        'claveSerieSinCifrar' => 'required',
    ];

    protected $messagesSinCifrar = [
        'mensajeSinCifrar.required' => 'El mensaje es requerido.',
        'claveSerieSinCifrar.required' => 'La clave es requerida.',
    ];

    protected $rulesCifrado = [
        'mensajeCifrado' => 'required',
        'claveSerieCifrado' => 'required',
    ];

    protected $messagesCifrado = [
        'mensajeCifrado.required' => 'El mensaje es requerido.',
        'claveSerieCifrado.required' => 'La clave es requerida.',
    ];

    public function render()
    {
        return view('livewire..transposicion.serie');
    }

    public function cifrar() {
        $this->validate($this->rulesSinCifrar, $this->messagesSinCifrar);
        $mensajeCifrado = $this->algoritmoCifradoPorSerie($this->mensajeSinCifrar, $this->claveSerieSinCifrar);
        $this->mensajeCifradoResultado = "'". $mensajeCifrado . "'";
    }
    
    public function descifrar() {
        $this->validate($this->rulesCifrado, $this->messagesCifrado);
        $mensajeDescifrado = $this->algoritmoDescifradoPorSerie($this->mensajeCifrado, $this->claveSerieCifrado);
        $this->mensajeDescifradoResultado = "'". $mensajeDescifrado ."'";
    }

    public function algoritmoCifradoPorSerie($mensaje, $clave) {
        $mensajeCifrado = '';
        $longitud = strlen($mensaje);
        $claveLength = strlen($clave);
    
        for ($i = 0; $i < $longitud; $i++) {
            $caracter = $mensaje[$i];
            $indiceClave = $i % $claveLength;
            $offset = ord($clave[$indiceClave]) - ord('a');
    
            $caracterCifrado = chr(ord($caracter) + $offset);
    
            $mensajeCifrado .= $caracterCifrado;
        }
    
        return $mensajeCifrado;
    }
    
    public function algoritmoDescifradoPorSerie($mensajeCifrado, $clave) {
        $mensajeDescifrado = '';
        $longitud = strlen($mensajeCifrado);
        $claveLength = strlen($clave);
    
        for ($i = 0; $i < $longitud; $i++) {
            $caracter = $mensajeCifrado[$i];
            $indiceClave = $i % $claveLength;
            $offset = ord($clave[$indiceClave]) - ord('a');
    
            $caracterDescifrado = chr(ord($caracter) - $offset);
    
            $mensajeDescifrado .= $caracterDescifrado;
        }
    
        return $mensajeDescifrado;
    }
}
