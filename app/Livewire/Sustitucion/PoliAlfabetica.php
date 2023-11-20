<?php

namespace App\Livewire\Sustitucion;

use Livewire\Component;

class PoliAlfabetica extends Component
{
    public $mensajeSinCifrar;
    public $claveSinCifrar;

    public $mensajeCifrado;
    public $claveCifrado;

    public $mensajeCifradoResultado;
    public $mensajeDescifradoResultado;

    protected $rulesSinCifrar = [
        'mensajeSinCifrar' => 'required',
        'claveSinCifrar' => 'required',
    ];

    protected $messagesSinCifrar = [
        'mensajeSinCifrar.required' => 'El mensaje es requerido.',
        'claveSinCifrar.required' => 'El tamaño del grupo es requerido.',
    ];

    protected $rulesCifrado = [
        'mensajeCifrado' => 'required',
        'claveCifrado' => 'required',
    ];

    protected $messagesCifrado = [
        'mensajeCifrado.required' => 'El mensaje es requerido.',
        'claveCifrado.required' => 'El tamaño del grupo es requerido.',
    ];

    public function render()
    {
        return view('livewire..sustitucion.poli-alfabetica');
    }

    public function cifrar()
    {
        $this->validate($this->rulesSinCifrar, $this->messagesSinCifrar);
        $mensajeCifrado = $this->algoritmoCifradoPoliAlfabetico($this->mensajeSinCifrar, $this->claveSinCifrar);
        $this->mensajeCifradoResultado = "'" . $mensajeCifrado . "'";
    }

    public function descifrar()
    {
        $this->validate($this->rulesCifrado, $this->messagesCifrado);
        $mensajeDescifrado = $this->algoritmoDescifradoPoliAlfabetico($this->mensajeCifrado, $this->claveCifrado);
        $this->mensajeDescifradoResultado = "'" . $mensajeDescifrado . "'";
    }

    public function algoritmoCifradoPoliAlfabetico($mensaje, $clave) {
        $mensajeCifrado = '';
        $claveRepetida = strtoupper(str_repeat($clave, ceil(strlen($mensaje) / strlen($clave))));
        
        foreach (str_split($mensaje) as $key => $caracter) {
            if (ctype_alpha($caracter)) {
                $ascii = ord('A');
                $caracterCifrado = chr(($ascii + (ord(strtoupper($caracter)) - $ascii + ord($claveRepetida[$key])) % 26) % 26 + $ascii);
                $mensajeCifrado .= ctype_upper($caracter) ? $caracterCifrado : strtolower($caracterCifrado);
            } else {
                $mensajeCifrado .= $caracter;
            }
        }
        return $mensajeCifrado;
    }

    public function algoritmoDescifradoPoliAlfabetico($mensajeCifrado, $clave) {
        $mensajeDescifrado = '';
        $claveRepetida = strtoupper(str_repeat($clave, ceil(strlen($mensajeCifrado) / strlen($clave))));

        foreach (str_split($mensajeCifrado) as $key => $caracter) {
            if (ctype_alpha($caracter)) {
                $ascii = ord('A');
                $caracterDescifrado = chr(($ascii + (ord(strtoupper($caracter)) - $ascii - ord($claveRepetida[$key]) + 26) % 26) % 26 + $ascii);
                $mensajeDescifrado .= ctype_upper($caracter) ? $caracterDescifrado : strtolower($caracterDescifrado);
            } else {
                $mensajeDescifrado .= $caracter;
            }
        }
        return $mensajeDescifrado;
    }
}
