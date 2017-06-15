<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
        return view('ingresar_oc');
    }

    /**
     * Guarda la orden de compra generadas por el usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function procesarOrdenCompra()
    {
        $data = request()->all();

        $this->ordenCompra->id_usuario = auth()->user()->id;
        $this->ordenCompra->id_producto = $data['id_producto'];
        $this->ordenCompra->cantidad = $data['cantidad'];
        $this->ordenCompra->valor_neto = $data['valor_neto'];
        $this->ordenCompra->iva = $data['iva'];
        $this->ordenCompra->valor_bruto = $data['valor_bruto'];
        $this->ordenCompra->cotizacion1 = $data['cotizacion_1'];
        $this->ordenCompra->cotizacion2 = $data['cotizacion_2'];
        $this->ordenCompra->cotizacion3 = $data['cotizacion_3'];
        $this->ordenCompra->autorizada = $data['autorizada'];
        $this->ordenCompra->facturada = $data['facturada'];
        $this->ordenCompra->comentario = $data['comentario'];

        $this->ordenCompra->save();
        return response()->json(['responseText' => 'Se ha ingresado la orden de compra!'], 200);
    }
    /**
     * carga vista que contiene la grilla de oc's
     *
     * @return \Illuminate\Http\Response
     */
    public function loadGrillaOrdenCompra()
    {
        return view('loadGrillaOC');
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
//        require_once("../pdf/dompdf_config.inc.php");
        $ordenes = $this->ordenCompra->listar();
//        $html = view('pdfOrdenesCompra',['ordenes' => $ordenes]);
//        $dompdf = new DOMPDF();
//        $dompdf->set_paper("letter", $orientation = "landscape");
//        $dompdf->load_html($html);
//        $dompdf->render();
//        $dompdf->stream("prueba.pdf");
//

//        die(print_r($html));
//        return \PDF::loadFile(public_path().'/pdfOrdenesCompra.blade.php')->setPaper('a4', 'landscape')->setWarnings(false)->save('ordenes_compra.pdf');
//        return \PDF::loadFile(public_path().'/pdfOrdenesCompra.blade.php')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');


        $pdf = \PDF::loadView('pdfOrdenesCompra',["ordenes" => $ordenes]);
        $pdf->setPaper("a4", "landscape");
        return $pdf->download('ordenes_compra.pdf');
    }
}