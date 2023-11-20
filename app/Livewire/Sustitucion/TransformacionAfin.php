<?php

namespace App\Livewire\Sustitucion;

use Livewire\Component;

class TransformacionAfin extends Component
{
    public $mensajeSinCifrar;
    public $coeficienteASinCifrar;
    public $coeficienteBSinCifrar;

    public $mensajeCifrado;
    public $coficienteACifrado;
    public $coficienteBCifrado;

    public $mensajeCifradoResultado;
    public $mensajeDescifradoResultado;

    public $modulo = 26;

    protected $rulesSinCifrar = [
        'mensajeSinCifrar' => 'required',
        'coeficienteASinCifrar' => 'required|integer',
        'coeficienteBSinCifrar' => 'required|integer',
    ];

    protected $messagesSinCifrar = [
        'mensajeSinCifrar.required' => 'El mensaje es requerido.',
        'coeficienteASinCifrar.required' => 'El coeficiente es requerido.',
        'coeficienteASinCifrar.integer' => 'El coeficiente debe ser un número entero.',
        'coeficienteASinCifrar.min' => 'El coeficiente debe ser mínimo de 2.',
        'coeficienteBSinCifrar.required' => 'El coeficiente es requerido.',
        'coeficienteBSinCifrar.integer' => 'El coeficiente debe ser un número entero.',
        'coeficienteBSinCifrar.min' => 'El coeficiente debe ser mínimo de 2.',
    ];

    protected $rulesCifrado = [
        'mensajeCifrado' => 'required',
        'coficienteACifrado' => 'required|integer',
        'coficienteBCifrado' => 'required|integer',
    ];

    protected $messagesCifrado = [
        'mensajeCifrado.required' => 'El mensaje es requerido.',
        'coficienteACifrado.required' => 'El coeficiente es requerido.',
        'coficienteACifrado.integer' => 'El coeficiente debe ser un número entero.',
        'coficienteACifrado.min' => 'El coeficiente debe ser mínimo de 2.',
        'coficienteBCifrado.required' => 'El coeficiente es requerido.',
        'coficienteBCifrado.integer' => 'El coeficiente debe ser un número entero.',
        'coficienteBCifrado.min' => 'El coeficiente debe ser mínimo de 2.',
    ];


    public function render()
    {
        return view('livewire..sustitucion.transformacion-afin');
    }

    public function cifrar()
    {
        $this->validate($this->rulesSinCifrar, $this->messagesSinCifrar);
        $mensajeCifrado = $this->algoritmoCifradoTransformacionAfin($this->mensajeSinCifrar, $this->coeficienteASinCifrar, $this->coeficienteBSinCifrar);
        $this->mensajeCifradoResultado = "'" . $mensajeCifrado . "'";
    }

    public function descifrar()
    {
        $this->validate($this->rulesCifrado, $this->messagesCifrado);
        $mensajeDescifrado = $this->algoritmoDescifradoTransformacionAfin($this->mensajeCifrado, $this->coficienteACifrado, $this->coficienteBCifrado);
        $this->mensajeDescifradoResultado = "'" . $mensajeDescifrado . "'";
    }

    public function algoritmoCifradoTransformacionAfin($mensaje, $coeficienteA, $coeficienteB) {
        $mensajeCifrado = '';
        foreach (str_split($mensaje) as $caracter) {
            if (ctype_alpha($caracter)) {
                $ascii = ord('A');
                $caracterCifrado = chr(($coeficienteA * (ord(strtoupper($caracter)) - $ascii) + $coeficienteB) % $this->modulo + $ascii);
                $mensajeCifrado .= ctype_upper($caracter) ? $caracterCifrado : strtolower($caracterCifrado);
            } else {
                $mensajeCifrado .= $caracter;
            }
        }
        return $mensajeCifrado;
    }

    public function algoritmoDescifradoTransformacionAfin($mensajeCifrado, $coeficienteA, $coeficienteB) {
        $mensajeDescifrado = '';
        $a_inverso = $this->modularInverso($coeficienteA, $this->modulo);

        foreach (str_split($mensajeCifrado) as $caracter) {
            if (ctype_alpha($caracter)) {
                $ascii = ord('A');
                $caracterDescifrado = chr($a_inverso * (ord(strtoupper($caracter)) - $ascii - $coeficienteB + $this->modulo) % $this->modulo + $ascii);
                $mensajeDescifrado .= ctype_upper($caracter) ? $caracterDescifrado : strtolower($caracterDescifrado);
            } else {
                $mensajeDescifrado .= $caracter;
            }
        }
        return $mensajeDescifrado;
    }

    private function modularInverso($a, $m) {
        for ($x = 1; $x < $m; $x++) {
            if (($a * $x) % $m == 1) {
                return $x;
            }
        }
        return 1;
    }
}
