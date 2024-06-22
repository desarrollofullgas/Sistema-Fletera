<?php

namespace App\Http\Livewire\Recepcion;

use App\Models\Cataport;
use App\Models\RecepcionPipa;
use App\Models\Unidad;
use Exception;
use Livewire\Component;

class NewRecepcion extends Component
{
    public $viajeID;
    //datos generales
    public $fFactura,$nFactura,$ltsFact,$precio,$tfgD='',$tfgC='',$retorno='',$pemex1,$pemex2;
    //datos de carga de combustible
    public $ciza="0 cm",$party_op=0,$llegada,$salida,$inicio,$fin;
    public $exVrAntDesc,$exVrDespDesc,$exFisAntDesc,$exFisDespDesc;
    public $aumBrVr,$ventDurDesc,$ltsAdc,$difLtsFact;
    public $difFis,$difLtsEnt;
    //datos de observaciones
    public $pipaStatus,$imgOp,$observaciones;

    public function addRecepcion(){
        //validación de datos generales
        $this->validate([
            'fFactura'=>'required',
            'nFactura'=>'required',
            'ltsFact'=>'required',
            'precio'=>'required',
            'tfgD'=>'required',
            'tfgC'=>'required',
            'retorno'=>'required',
            'pemex1'=>'required',
            'pemex2'=>'required',
        ],[
            'fFactura.required'=>'Ingrese la fecha de la factura',
            'nFactura.required'=>'Ingrese el número de la factura',
            'ltsFact.required'=>'Ingrese los litros facturados',
            'precio.required'=>'Ingrese el precio unitario',
            'tfgD.required'=>'Este sello es necesario',
            'tfgC.required'=>'Este sello es necesario',
            'retorno.required'=>'Este sello es necesario',
            'pemex1.required'=>'Este sello es necesario',
            'pemex2.required'=>'Este sello es necesario',
        ]);
        //validación de carga de combustible y observaciones
        $this->validate([
            'llegada'=>['required'],
            'salida'=>['required'],
            'inicio'=>['required'],
            'fin'=>['required'],
            'exVrAntDesc'=>['required'],
            'exVrDespDesc'=>['required'],
            'exFisAntDesc'=>['required'],
            'exFisDespDesc'=>['required'],
            'aumBrVr'=>['required'],
            'ventDurDesc'=>['required'],
            'ltsAdc'=>['required'],
            'difLtsFact'=>['required'],
            'difFis'=>['required'],
            'difLtsEnt'=>['required'],
            'pipaStatus'=>['required'],
            'imgOp'=>['required']
        ],[
            'llegada.required'=>'Este campo es requerido',
            'salida.required'=>'Este campo es requerido',
            'inicio.required'=>'Este campo es requerido',
            'fin.required'=>'Este campo es requerido',
            'exVrAntDesc.required'=>'Este campo es requerido',
            'exVrDespDesc.required'=>'Este campo es requerido',
            'exFisAntDesc.required'=>'Este campo es requerido',
            'exFisDespDesc.required'=>'Este campo es requerido',
            'aumBrVr.required'=>'Este campo es requerido',
            'ventDurDesc.required'=>'Este campo es requerido',
            'ltsAdc.required'=>'Este campo es requerido',
            'difLtsFact.required'=>'Este campo es requerido',
            'difFis.required'=>'Este campo es requerido',
            'difLtsEnt.required'=>'Este campo es requerido',
            'pipaStatus.required'=>'Este campo es requerido',
            'imgOpc.required'=>'Este campo es requerido'
        ]);
        try{
            //dd($this->party_op);
            $viaje=Cataport::find($this->viajeID);
            $unidad=Unidad::find($viaje->unidad_id);
            $recepcion= new RecepcionPipa();
            $recepcion->cataporte_id=$this->viajeID;
            //datos generales
            $recepcion->fecha_factura=$this->fFactura;
            $recepcion->remision_fac=$this->nFactura;
            $recepcion->importe=$this->ltsFact;
            $recepcion->costos_uni=$this->precio;
            $viaje->sello_tfgd=$this->tfgD;
            $viaje->sello_tfgc=$this->tfgC;
            $viaje->sello_r=$this->retorno;
            $viaje->status="Finalizado";
            $recepcion->selloP1=$this->pemex1;
            $recepcion->selloP2=$this->pemex2;
            //datos de carga de combustible
            $recepcion->ciza=$this->ciza;
            $recepcion->parti_gerente=$this->party_op;
            $recepcion->hora_llegada=$this->llegada;
            $recepcion->hora_salida=$this->salida;
            $recepcion->hora_desc_in=$this->inicio;
            $recepcion->hora_desc_fin=$this->fin;
            $recepcion->ant_desc_vroot=$this->exVrAntDesc;
            $recepcion->desp_desc_vroot=$this->exVrDespDesc;
            $recepcion->ant_desc_fisico=$this->exFisAntDesc;
            $recepcion->desp_desc_fisico=$this->exFisDespDesc;
            $recepcion->aum_desc_vroot=$this->aumBrVr;
            $recepcion->venta_dur_descarga=$this->ventDurDesc;
            $recepcion->litros_adicionales=$this->ltsAdc;
            $recepcion->dif_litros_fact_root=$this->difLtsFact;
            $recepcion->aum_desc_fisico=$this->difFis;
            $recepcion->dif_lent_fisico=$this->difLtsEnt;
            //observaciones
            $recepcion->status_pipa=$this->pipaStatus;
            $recepcion->observacion_op=$this->imgOp;
            $recepcion->observaciones=$this->observaciones;

            //actualizar estado de unidad de transporte
            $unidad->status="Disponible";
            $viaje->save();
            $recepcion->save();
            $unidad->save();
            session()->flash('flash.banner', 'Recepción del viaje #'.$this->viajeID. ' guardado corectamente');
            session()->flash('flash.bannerStyle', 'success');
            return to_route('viajes');
        }catch(Exception $error){
            session()->flash('flash.banner', 'Ha ocurrido un error al realizar la recepción. Pongase en contacto con un administrador y proporcione el siguiente código:'.$error->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            return  to_route('viajes');
        }
    }
    public function render()
    {
        return view('livewire.recepcion.new-recepcion');
    }
}
