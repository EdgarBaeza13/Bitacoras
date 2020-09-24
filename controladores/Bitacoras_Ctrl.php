<?php

class Bitacoras_Ctrl
{
    public $M_Bitacora = null;

    public function __construct() 

    {
      $this->M_Bitacora = new M_Bitacoras();
    }

    public function crear($f3)
    {
        $this->M_Bitacora->set('id_cliente', $f3->get('POST.id_cliente'));
        $this->M_Bitacora->set('id_equipo', $f3->get('POST.id_equipo'));
        $this->M_Bitacora->set('id_servicio', $f3->get('POST.id_servicio'));
        $this->M_Bitacora->set('fecha', $f3->get('POST.fecha'));
        $this->M_Bitacora->set('diagnostico', $f3->get('POST.diagnostico'));
        $this->M_Bitacora->set('precio', $f3->get('POST.precio'));
        $this->M_Bitacora->save();
        echo json_encode([
            'mensaje' => 'Bitacora creada',
            'info'=> [
                'id' => $this->M_Bitacora->get('id_bitacora')

            ]
        ]);
        
       
    }

    public function consultar($f3)
    {
        $idbitacora= $f3->get('PARAMS.idbitacora');
        $this->M_Bitacora->load(['id_bitacora = ?', $idbitacora]);
        $msg= "";
        $item = array();

        if($this->M_Bitacora->loaded() > 0){
            $msg = "bitacora encontrada";
            $item = $this->M_Bitacora->cast();
        } else {
            $msg = "La bitacora no existe";
        }
        echo json_encode([
            'mensaje' => $msg,
            'info'=> [
                'item' => $item

            ]
        ]);


    }

    public function listado($f3)
    {
       $result= $this->M_Bitacora->find();
       $items= array();
       foreach($result as $bitacora){
           $items[] = $bitacora->cast();
       }
       echo json_encode([
        'mensaje' => count($items) > 0 ? '' : 'Aun no hay registros',
        'info'=> [
            'items' => $items,
            'total' => count($items)
        ]
    ]);
        
    }

    public function eliminar($f3)
    {
        $idbitacora= $f3->get('POST.idbitacora');
        $this->M_Bitacora->load(['id_bitacora = ?', $idbitacora]);
        $msg= "";

        if($this->M_Bitacora->loaded() > 0){
            $msg = "bitacora eliminado";
            $this->M_Bitacora->erase();
        } else {
            $msg = "El bitacora no existe";
        }
        echo json_encode([
            'mensaje' => $msg,
            'info'=> []
        ]);

    }

    public function actualizar($f3)
    {
        $idcliente= $f3->get('PARAMS.idbitacora');
        $this->M_Bitacora->load(['id_bitacora = ?', $idbitacora]);
        $msg= "";

        if($this->M_Bitacora->loaded() > 0){
            $this->M_Bitacora->set('id_cliente', $f3->get('POST.id_cliente'));
            $this->M_Bitacora->set('id_equipo', $f3->get('POST.id_equipo'));
            $this->M_Bitacora->set('id_servicio', $f3->get('POST.id_servicio'));
            $this->M_Bitacora->set('fecha', $f3->get('POST.fecha'));
            $this->M_Bitacora->set('diagnostico', $f3->get('POST.diagnostico'));
            $this->M_Bitacora->set('precio', $f3->get('POST.precio'));

            $this->M_Bitacora->save();
            $msg = "bitacora actualizada actuaizada";
            
        } else {
            $msg = "La bitacora no existe";
        }
        echo json_encode([
            'mensaje' => $msg,
            'info'=> []
        ]);

    }
}