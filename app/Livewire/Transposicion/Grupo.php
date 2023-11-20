<?php

namespace App\Livewire\Transposicion;

use Livewire\Component;

class Grupo extends Component
{
    public $mensajeSinCifrar;
    public $tamanioGrupoSinCifrar;

    public $mensajeCifrado;
    public $tamanioGrupoCifrado;

    public $mensajeCifradoResultado;
    public $mensajeDescifradoResultado;  

    protected $rulesSinCifrar = [
        'mensajeSinCifrar' => 'required',
        'tamanioGrupoSinCifrar' => 'required|integer|min:2',
    ];

    protected $messagesSinCifrar = [
        'mensajeSinCifrar.required' => 'El mensaje es requerido.',
        'tamanioGrupoSinCifrar.required' => 'El tamaño del grupo es requerido.',
        'tamanioGrupoSinCifrar.integer' => 'El tamaño del grupo debe ser un número entero.',
        'tamanioGrupoSinCifrar.min' => 'El tamaño del grupo debe ser mínimo de 2.',
    ];

    protected $rulesCifrado = [
        'mensajeCifrado' => 'required',
        'tamanioGrupoCifrado' => 'required|integer|min:2',
    ];

    protected $messagesCifrado = [
        'mensajeCifrado.required' => 'El mensaje es requerido.',
        'tamanioGrupoCifrado.required' => 'El tamaño del grupo es requerido.',
        'tamanioGrupoCifrado.integer' => 'El tamaño del grupo debe ser un número entero.',
        'tamanioGrupoCifrado.min' => 'El tamaño del grupo debe ser mínimo de 2.',
    ];

    public function render()
    {
        return view('livewire..transposicion.grupo');
    }

    public function cifrar() {
        $this->validate($this->rulesSinCifrar, $this->messagesSinCifrar);
        $mensajeCifrado = $this->algoritmoCifradoPorGrupo($this->mensajeSinCifrar, $this->tamanioGrupoSinCifrar);
        $this->mensajeCifradoResultado = "'". $mensajeCifrado . "'";
    }
    
    public function descifrar() {
        $this->validate($this->rulesCifrado, $this->messagesCifrado);
        $mensajeDescifrado = $this->algoritmoCifradoPorGrupo($this->mensajeCifrado, $this->tamanioGrupoCifrado);
        $this->mensajeDescifradoResultado = "'". $mensajeDescifrado ."'";
    }

    public function algoritmoCifradoPorGrupo($mensaje, $tamanioGrupo) {
        $mensajeCifrado = '';
        $longitud = strlen($mensaje);

        for ($i = 0; $i < $longitud; $i += $tamanioGrupo) {
            $grupo = substr($mensaje, $i, $tamanioGrupo);
            $mensajeCifrado .= strrev($grupo); 
        }
    
        return $mensajeCifrado;
    }
}
