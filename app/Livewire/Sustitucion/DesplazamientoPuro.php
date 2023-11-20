<?php

namespace App\Livewire\Sustitucion;

use Livewire\Component;

class DesplazamientoPuro extends Component
{
    public $mensajeSinCifrar;
    public $desplazamientoSinCifrar;

    public $mensajeCifrado;
    public $desplazamientoCifrado;

    public $mensajeCifradoResultado;
    public $mensajeDescifradoResultado;

    protected $rulesSinCifrar = [
        'mensajeSinCifrar' => 'required',
        'desplazamientoSinCifrar' => 'required|integer|min:2',
    ];

    protected $messagesSinCifrar = [
        'mensajeSinCifrar.required' => 'El mensaje es requerido.',
        'desplazamientoSinCifrar.required' => 'El tamaño del desplazamiento es requerido.',
        'desplazamientoSinCifrar.integer' => 'El tamaño del desplazamiento debe ser un número entero.',
        'desplazamientoSinCifrar.min' => 'El tamaño del desplazamiento debe ser mínimo de 2.',
    ];

    protected $rulesCifrado = [
        'mensajeCifrado' => 'required',
        'desplazamientoCifrado' => 'required|integer|min:2',
    ];

    protected $messagesCifrado = [
        'mensajeCifrado.required' => 'El mensaje es requerido.',
        'desplazamientoCifrado.required' => 'El tamaño del desplazamiento es requerido.',
        'desplazamientoCifrado.integer' => 'El tamaño del desplazamiento debe ser un número entero.',
        'desplazamientoCifrado.min' => 'El tamaño del desplazamiento debe ser mínimo de 2.',
    ];

    public function render()
    {
        return view('livewire..sustitucion.desplazamiento-puro');
    }

    public function cifrar()
    {
        $this->validate($this->rulesSinCifrar, $this->messagesSinCifrar);
        $mensajeCifrado = $this->algoritmoCifrarPorDesplazamiento($this->mensajeSinCifrar, $this->desplazamientoSinCifrar);
        $this->mensajeCifradoResultado = "'" . $mensajeCifrado . "'";
    }

    public function descifrar()
    {
        $this->validate($this->rulesCifrado, $this->messagesCifrado);
        $mensajeDescifrado = $this->algoritmoDescifrarPorDesplazamiento($this->mensajeCifrado, $this->desplazamientoCifrado);
        $this->mensajeDescifradoResultado = "'" . $mensajeDescifrado . "'";
    }

    public function algoritmoCifrarPorDesplazamiento($mensaje, $desplazamiento) {
        $mensajeCifrado = '';
        foreach (str_split($mensaje) as $caracter) {
            if (ctype_alpha($caracter)) {
                $ascii = ord('A');
                $caracterCifrado = chr(($ascii + ord(strtoupper($caracter)) + $desplazamiento) % 26 + $ascii);
                $mensajeCifrado .= ctype_upper($caracter) ? $caracterCifrado : strtolower($caracterCifrado);
            } else {
                $mensajeCifrado .= $caracter;
            }
        }
        return $mensajeCifrado;
    }

    public function algoritmoDescifrarPorDesplazamiento($mensajeCifrado, $desplazamiento) {
        $mensajeDescifrado = '';
        foreach (str_split($mensajeCifrado) as $caracter) {
            if (ctype_alpha($caracter)) {
                $ascii = ord('A');
                $caracterDescifrado = chr(($ascii + ord(strtoupper($caracter)) - $desplazamiento + 26) % 26 + $ascii);
                $mensajeDescifrado .= ctype_upper($caracter) ? $caracterDescifrado : strtolower($caracterDescifrado);
            } else {
                $mensajeDescifrado .= $caracter;
            }
        }
        return $mensajeDescifrado;
    }
}
