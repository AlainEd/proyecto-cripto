<?php

namespace App\Livewire\Sustitucion;

use Livewire\Component;

class MonoAlfabetica extends Component
{
    public $mensajeSinCifrar;
    public $claveSinCifrar = 'BCDEFGHIJKLMNOPQRSTUVWXYZA';

    public $mensajeCifrado;
    public $claveCifrado = 'BCDEFGHIJKLMNOPQRSTUVWXYZA';

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
        return view('livewire..sustitucion.mono-alfabetica');
    }

    public function cifrar()
    {
        $this->validate($this->rulesSinCifrar, $this->messagesSinCifrar);
        $mensajeCifrado = strtr($this->mensajeSinCifrar, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', $this->claveSinCifrar);
        $this->mensajeCifradoResultado = "'" . $mensajeCifrado . "'";
    }

    public function descifrar()
    {
        $this->validate($this->rulesCifrado, $this->messagesCifrado);
        $mensajeDescifrado = strtr($this->mensajeCifrado, $this->claveCifrado, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $this->mensajeDescifradoResultado = "'" . $mensajeDescifrado . "'";
    }
}
