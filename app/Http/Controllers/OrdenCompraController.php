<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Proveedor;
use App\Proyecto;
use App\DetalleOrdenCompra;
use App\TipoPago;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\OrdenCompra;
use Illuminate\Support\Facades\Session;


class OrdenCompraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrdenCompra $ordenCompra)
    {
        $this->middleware('auth');
        $this->ordenCompra = $ordenCompra;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ingresarOrdenCompra()
    {
        $proyectos = Proyecto::all();
        $proveedores = Proveedor::all();
        $tiposPago = TipoPago::all();
        $listaProyectos = array();
        $listaProveedores = array();
        $listaFormaPago = array();
        foreach ($proyectos as $proyecto)
        {
            $listaProyectos[$proyecto->id_proyecto] = $proyecto->codigo;
        }
        foreach ($proveedores as $proveedor)
        {
            $listaProveedores[$proveedor->id_proveedor] = $proveedor->rut;
        }
        foreach ($tiposPago as $tipoPago)
        {
            $listaFormaPago[$tipoPago->id_tipo_pago] = $tipoPago->descripcion;
        }
        return view('ingresar_oc',['listaProyectos' => $listaProyectos, 'listaProveedores' => $listaProveedores, 'listaFormaPago' => $listaFormaPago]);
    }

    public function editarOrdenCompra()
    {
        $data = request()->all();
        $idOrdenCompra = $data['id'];
        $ordenCompra = OrdenCompra::find($idOrdenCompra);
        $proveedor = OrdenCompra::find($ordenCompra->id_proveedor);
        $detalles = DetalleOrdenCompra::all()->where('id_orden_compra',$idOrdenCompra);

        $proyectos = Proyecto::all();
        $proveedores = Proveedor::all();
        $tiposPago = TipoPago::all();
        $listaProyectos = array();
        $listaProveedores = array();
        $listaFormaPago = array();
        foreach ($proyectos as $proyecto)
        {
            $listaProyectos[$proyecto->id_proyecto] = $proyecto->codigo;
        }
        foreach ($proveedores as $proveedor)
        {
            $listaProveedores[$proveedor->id_proveedor] = $proveedor->rut;
        }
        foreach ($tiposPago as $tipoPago)
        {
            $listaFormaPago[$tipoPago->id_tipo_pago] = $tipoPago->descripcion;
        }
        return view('editar_oc',['listaProyectos' => $listaProyectos, 'listaProveedores' => $listaProveedores, 'listaFormaPago' => $listaFormaPago, 'ordenCompra' => $ordenCompra,'detalles' =>$detalles,'proveedor' =>$proveedor]);
    }
    
    public function addDetalleOrdenCompra()
    {
        $data = request()->all();
        $row = $data['row'];
        $html = '<div id="detalle_oc_'.$row.'" class="form-group">
                    <div class="col-xs-1">
                        <label for="detalle['.$row.'][codigo]">Código</label>
                        <input required name="detalle['.$row.'][codigo]" type="text" value="" id="detalle['.$row.'][codigo]" class="form-control">
                    </div>
                    <div class="col-xs-1">
                        <label for="detalle['.$row.'][cantidad]">Cantidad</label>
                        <input required name="detalle['.$row.'][cantidad]" type="number" value="" id="detalle_'.$row.'_cantidad" data-row="'.$row.'" class="form-control detalle_oc">
                    </div>
                    <div class="col-xs-5">
                        <label for="detalle['.$row.'][item]">Item</label>
                        <input required name="detalle['.$row.'][item]" type="text" value="" id="detalle['.$row.'][item]" class="form-control">
                    </div>
                    <div class="col-xs-2">
                        <label for="detalle['.$row.'][valor_unitario]">Valor Unitario</label>
                        <input required name="detalle['.$row.'][valor_unitario]" type="number" value="" id="detalle_'.$row.'_valor_unitario" data-row="'.$row.'" class="form-control detalle_oc">
                    </div>
                    <div class="col-xs-2">
                        <label for="detalle['.$row.'][valor_total]">Valor Total</label>
                        <input name="detalle['.$row.'][valor_total]" type="number" value="" id="detalle_'.$row.'_valor_total" data-row="'.$row.'" readonly class="form-control">
                    </div>
                    <div class="col-xs-1">
                        </br><button type="button" data-id="'.$row.'" class="delete_detalle_oc btn btn-danger btn-sm btn-round"><span class="glyphicon glyphicon-minus"></span></button>
                    </div>
                </div>';
        return response()->json(['responseText' => $html], 200);
    }
    
    public function loadProveedor()
    {
        $data = request()->all();
        $proveedor = Proveedor::find($data['id']);
        return response()->json(['responseText' => $proveedor],200);
    }

    /**
     * Guarda la orden de compra generadas por el usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function procesarOrdenCompra()
    {
        $data = request()->all();

        if(array_key_exists('is_new_proveedor',$data))
        {
            $proveedor = new Proveedor();
            $proveedor->nombre = $data['nombre'];
            $proveedor->direccion = $data['direccion'];
            $proveedor->rut = $data['rut'];
            $proveedor->comuna = $data['comuna'];
            $proveedor->giro = $data['giro'];
            $proveedor->email = $data['email'];
            $proveedor->telefono = $data['telefono_fijo'];
            $proveedor->telefono_movil = $data['telefono_movil'];
            $proveedor->save();
        }
        else{
            $proveedor = Proveedor::find($data['id_proveedor']);
        }
        $idProveedor = $proveedor->id_proveedor;

        if(array_key_exists('is_new_project',$data))
        {
            $proyecto = new Proyecto();
            $proyecto->codigo = $data['codigo_proyecto'];
            $proyecto->save();
        }else{
            $proyecto = Proyecto::find($data['id_proyecto']);
        }
        $idProyecto = $proyecto->id_proyecto;
        if(array_key_exists('id_orden_compra',$data) && $data['id_orden_compra'])
        {
            $this->ordenCompra->find($data['id_orden_compra']);
        }

        $this->ordenCompra->id_usuario = auth()->user()->id;
        $this->ordenCompra->id_proyecto = $idProyecto;
        $this->ordenCompra->id_proveedor = $idProveedor;
        $this->ordenCompra->fecha_emision = $data['fecha_emision'];
        $this->ordenCompra->id_tipo_pago = $data['id_tipo_pago'];
        $this->ordenCompra->plazo_entrega = $data['plazo_entrega'];
        if(array_key_exists('factura_exenta',$data)) {
            $this->ordenCompra->factura_exenta = 1;
        }else{
            $this->ordenCompra->factura_exenta = 0;
        }
        $this->ordenCompra->solicita = $data['solicita'];
        $this->ordenCompra->autoriza = $data['autoriza'];
        $this->ordenCompra->revisa = $data['revisa'];
        $this->ordenCompra->observacion = $data['observacion'];
        $this->ordenCompra->save();

        $detalles = $data['detalle'];
        foreach ($detalles as $detalle)
        {
            $detalleOC = new DetalleOrdenCompra();
            $detalleOC->id_orden_compra = $this->ordenCompra->id_orden_compra;
            $detalleOC->codigo = $detalle['codigo'];
            $detalleOC->cantidad = $detalle['cantidad'];
            $detalleOC->item = $detalle['item'];
            $detalleOC->valor_unitario = $detalle['valor_unitario'];
            $detalleOC->valor_total = $detalle['valor_total'];
            $detalleOC->save();
        }
        return redirect()->route('home');
    }
    /**
     * carga vista que contiene la grilla de oc's
     *
     * @return \Illuminate\Http\Response
     */
    public function loadGrillaOrdenCompra()
    {
        $idAdmin = auth()->user()->id;
        return view('loadGrillaOC',['isAdmin' => $idAdmin]);
    }
    
    /**
     * genera la grilla con las ordenes de compra generadas por el usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function grillaOrdenCompra()
    {
        $ordenes = $this->ordenCompra->listar();
        return Datatables::of($ordenes)->make(true);
    }

    /**
     * genera y retorna un PDF con las ordenes de compra
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadPDFOC()
    {
        $data = request()->all();
        $ordenCompra = $this->ordenCompra->find($data['id']);
        $detalles = DetalleOrdenCompra::all()->where('id_orden_compra',$data['id']);
        $proveedor = Proveedor::find($ordenCompra->id_proveedor);
        $tipoPago = TipoPago::find($ordenCompra->id_tipo_pago)->descripcion;
        $pdf = \PDF::loadView('pdfOrdenesCompra',["ordenCompra" => $ordenCompra,'detalles' => $detalles,'proveedor' => $proveedor,'tipoPago' => $tipoPago]);
        $pdf->setPaper("a4");
        return $pdf->download('ordenes_compra.pdf');
    }

    public function deleteOrdenCompra()
    {
        $data = request()->all();
        $ordenCompra = $this->ordenCompra->find($data['id']);
        $ordenCompra->delete();
        return response()->json(['responseText' => 'OK'],200);
    }

    public function autorizarOrdenCompra()
    {
        $data = request()->all();
        $ordenCompra = $this->ordenCompra->find($data['id']);
        $ordenCompra->autorizada = 1;
        $ordenCompra->save();
        return response()->json(['responseText' => 'OK'],200);
    }

    public function uploadCotizacion()
    {
        $data = request()->all();
        $idOC = $data['cotizacion_id_orden_compra'];
        $ordenCompra = $this->ordenCompra->find($idOC);
        $carpeta = 'uploads/cotizaciones';
//        if (!file_exists($carpeta)) {
//            @mkdir($carpeta, 0777, true);
//        }
        if(request()->hasFile('cotizacion1'))
        {
            $cot1 = request()->file('cotizacion1');
            $extension = $cot1->guessExtension();
            if(file_exists($carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_1'))
            {
                @unlink($carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_1');
            }
            $cot1->move($carpeta,$idOC.'_cotizacion_1.'.$extension);
            $ordenCompra->cotizacion1 = $carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_1.'.$extension;
        }
        if(request()->hasFile('cotizacion2'))
        {
            $cot2 = request()->file('cotizacion2');
            $extension = $cot2->guessExtension();
            if(file_exists($carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_2'))
            {
                @unlink($carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_2');
            }
            $cot2->move($carpeta,$idOC.'_cotizacion_2.'.$extension);
            $ordenCompra->cotizacion2 = $carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_2.'.$extension;
        }
        if(request()->hasFile('cotizacion3'))
        {
            $cot3 = request()->file('cotizacion3');
            $extension = $cot3->guessExtension();
            if(file_exists($carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_3'))
            {
                @unlink($carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_3');
            }
            $cot3->move($carpeta,$idOC.'_cotizacion_3.'.$extension);
            $ordenCompra->cotizacion3 = $carpeta.DIRECTORY_SEPARATOR.$idOC.'_cotizacion_3.'.$extension;
        }
        $ordenCompra->save();
        return redirect()->route('home');
    }
}