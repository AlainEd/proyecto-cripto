<?php

namespace App\Livewire\Transposicion;

use Livewire\Component;

class ZigZag extends Component
{
    public $mensajeSinCifrar;
    public $lineasSinCifrar;

    public $mensajeCifrado;
    public $lineasCifrado;

    public $mensajeCifradoResultado;
    public $mensajeDescifradoResultado;

    protected $rulesSinCifrar = [
        'mensajeSinCifrar' => 'required',
        'lineasSinCifrar' => 'required',
    ];

    protected $messagesSinCifrar = [
        'mensajeSinCifrar.required' => 'El mensaje es requerido.',
        'lineasSinCifrar.required' => 'La clave es requerida.',
    ];

    protected $rulesCifrado = [
        'mensajeCifrado' => 'required',
        'lineasCifrado' => 'required',
    ];

    protected $messagesCifrado = [
        'mensajeCifrado.required' => 'El mensaje es requerido.',
        'lineasCifrado.required' => 'La clave es requerida.',
    ];

    public function render()
    {
        return view('livewire..transposicion.zig-zag');
    }

    public function cifrar()
    {
        $this->validate($this->rulesSinCifrar, $this->messagesSinCifrar);
        $matriz = $this->construirMatriz($this->mensajeSinCifrar, $this->lineasSinCifrar, true);
        $this->mensajeCifradoResultado = "'" . $this->leerMatriz($matriz) . "'";
    }

    public function descifrar()
    {
        $this->validate($this->rulesCifrado, $this->messagesCifrado);
        $matriz = $this->construirMatriz($this->mensajeCifrado, $this->lineasCifrado, false);
        $this->mensajeDescifradoResultado = "'" . $this->leerMatriz($matriz) . "'";
    }

    private function construirMatriz($mensaje, $lineas, $cifrar)
    {
        $longitud = strlen($mensaje);
        $matriz = array_fill(0, $lineas, '');

        $fila = 0;
        $direccion = 1; // 1 para moverse hacia abajo, -1 para moverse hacia arriba

        for ($i = 0; $i < $longitud; $i++) {
            $matriz[$fila] .= $mensaje[$i];
            $fila += $direccion;

            // Cambiar la dirección si alcanza los extremos de las líneas
            if ($fila == 0 || $fila == $lineas - 1) {
                $direccion *= -1;
            }
        }

        return $matriz;
    }

    private function leerMatriz($matriz)
    {
        $mensajeResultado = '';
        $longitud = max(array_map('strlen', $matriz));

        for ($i = 0; $i < $longitud; $i++) {
            foreach ($matriz as $fila) {
                if (isset($fila[$i])) {
                    $mensajeResultado .= $fila[$i];
                }
            }
        }

        return $mensajeResultado;
    }
}
