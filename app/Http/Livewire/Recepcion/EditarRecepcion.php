<?php

namespace App\Http\Livewire\Recepcion;

use App\Models\Cataport;
use App\Models\RecepcionPipa;
use Exception;
use Livewire\Component;

class EditarRecepcion extends Component
{
    public $viajeID,$viaje;
    //datos generales
    public $fFactura,$nFactura,$ltsFact,$precio,$tfgD='',$tfgC='',$retorno='',$pemex1,$pemex2;
    //datos de carga de combustible
    public $ciza,$party_op=0,$llegada,$salida,$inicio,$fin;
    public $exVrAntDesc,$exVrDespDesc,$exFisAntDesc,$exFisDespDesc;
    public $aumBrVr,$ventDurDesc,$ltsAdc,$difLtsFact;
    public $difFis,$difLtsEnt;
    //datos de observaciones
    public $pipaStatus,$imgOp,$observaciones;

    public function mount(){
        $this->viaje=Cataport::find($this->viajeID);
        $recepcion=$this->viaje->recepcion;
        //datos generales
        $this->fFactura=$recepcion->fecha_factura;
        $this->nFactura=$recepcion->remision_fac;
        $this->ltsFact=$recepcion->importe;
        $this->precio=$recepcion->costos_uni;
        $this->tfgD=$this->viaje->sello_tfgd;
        $this->tfgC=$this->viaje->sello_tfgc;
        $this->retorno=$this->viaje->sello_r;
        $this->pemex1=$recepcion->selloP1;
        $this->pemex2=$recepcion->selloP2;
        //datos de carga de combustible
        $this->ciza=$recepcion->ciza;
        $this->party_op=$recepcion->parti_gerente;
        $this->llegada=$recepcion->hora_llegada;
        $this->salida=$recepcion->hora_salida;
        $this->inicio=$recepcion->hora_desc_in;
        $this->fin=$recepcion->hora_desc_fin;
        $this->exVrAntDesc=$recepcion->ant_desc_vroot;
        $this->exVrDespDesc=$recepcion->desp_desc_vroot;
        $this->exFisAntDesc=$recepcion->ant_desc_fisico;
        $this->exFisDespDesc=$recepcion->desp_desc_fisico;
        $this->aumBrVr=$recepcion->aum_desc_vroot;
        $this->ventDurDesc= $recepcion->venta_dur_descarga;
        $this->ltsAdc=$recepcion->litros_adicionales;
        $this->difLtsFact=$recepcion->dif_litros_fact_root;
        $this->difFis=$recepcion->aum_desc_fisico;
        $this->difLtsEnt=$recepcion->dif_lent_fisico;
        //datos de observaciones
        $this->pipaStatus=$recepcion->status_pipa;
        $this->imgOp=$recepcion->observacion_op;
        $this->observaciones=$recepcion->observaciones;
    }
    public function updateRecepcion(){
        try{
            //dd($this->party_op);
            $viaje=Cataport::find($this->viajeID);
            $recepcion= RecepcionPipa::find($viaje->recepcion->id);
            $recepcion->cataporte_id=$this->viajeID;
            //datos generales
            $recepcion->fecha_factura=$this->fFactura;
            $recepcion->remision_fac=$this->nFactura;
            $recepcion->importe=$this->ltsFact;
            $recepcion->costos_uni=$this->precio;
            $viaje->sello_tfgd=$this->tfgD;
            $viaje->sello_tfgc=$this->tfgC;
            $viaje->sello_r=$this->retorno;
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
            session()->flash('flash.banner', 'Recepción del viaje #'.$this->viajeID. ' fue actualizada');
            session()->flash('flash.bannerStyle', 'success');
            return to_route('viajes');
        }catch(Exception $error){
            session()->flash('flash.banner', 'Ha ocurrido un error al actualizar la información. Pongase en contacto con un administrador y proporcione el siguiente código:'.$error->getMessage());
            session()->flash('flash.bannerStyle', 'success');
            return  to_route('viajes');
        }
    }
    public function render()
    {
        return view('livewire.recepcion.editar-recepcion');
    }
}
