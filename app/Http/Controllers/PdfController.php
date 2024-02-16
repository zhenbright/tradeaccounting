<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends Controller
{
    public function __construct(){
        
    }
    
    public function generatePdf(Request $request)
    {
        // return ;


        // Render the HTML as PDF
        $pdfname = $request['pdfname'];
        $tabledata = json_decode($request->tabledata);
        $fromdown = $request['fromdown'];
        $todown = $request['todown'];
        $date = $request['date'];
        $tot = $request['tot'];
        // echo $tabledata;
        // die;
        $data = [
            'title' => $pdfname,
            'date' => $date,
            'tabledataes' => $tabledata,
            'fromdown' => $fromdown,
            'todown' => $todown,
            'tot' => $tot
        ];
        $pdf = new Dompdf();
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $pdf->setOptions($options);
        $pdf->setPaper('Letter', 'landscape');
        $pdf->loadHtml(view('pdf', $data));

        $pdf->render();

        
        $pdf->stream("T-".$pdfname.".pdf");
        return ;
    }
}
