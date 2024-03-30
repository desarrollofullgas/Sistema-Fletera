<?php

namespace App\Http\Livewire\Recepcion;

use App\Models\Cataport;
use App\Models\RecepcionPipa;
use Exception;
use Livewire\Component;

class NewRecepcion extends Component
{
    public $viajeID;
    //datos generales
    public $fFactura,$nFactura,$ltsFact,$precio,$tfgD='',$tfgC='',$retorno='',$pemex1,$pemex2;
    //datos de carga de combustible
    public $ciza,$party_op=0,$llegada,$salida,$inicio,$fin;
    public $exVrAntDesc,$exVrDespDesc,$exFisAntDesc,$exFisDespDesc;
    public $aumBrVr,$ventDurDesc,$ltsAdc,$difLtsFact;
    public $difFis,$difLtsEnt;
    //datos de observaciones
    public $pipaStatus,$imgOp,$observaciones;

    public function addRecepcion(){
        try{
            //dd($this->party_op);
            $viaje=Cataport::find($this->viajeID);
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
    
            $viaje->save();
            $recepcion->save();
            session()->flash('flash.banner', 'Recepción del viaje #'.$this->viajeID. ' guardado corectamente');
            session()->flash('flash.bannerStyle', 'success');
            return to_route('viajes');
        }catch(Exception $error){
            session()->flash('flash.banner', 'Ha ocurrido un error al realizar la recepción. Pongase en contacto con un administrador y proporcione el siguiente código:'.$error->getMessage());
            session()->flash('flash.bannerStyle', 'success');
            return  to_route('viajes');
        }
    }
    public function render()
    {
        return view('livewire.recepcion.new-recepcion');
    }
}
