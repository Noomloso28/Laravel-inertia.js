<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotation = [
          'tilte' => 'title',
          'description' => 'description'
        ];

//        $pdf = PDF::loadView('quotation.pdf', compact('quotation'));
//        $pdfPath = public_path('quotations/test.pdf');
////        dd($pdfPath);
//        $pdf->save($pdfPath);
        $pdf = PDF::loadView('quotation.pdf',compact('quotation'));
//        return $pdf->download('pdfview.pdf');
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd($request);
//        $request->validate([
//            'title' => 'required',
//            'description' => 'required',
//        ]);

        // Generate PDF
//        $pdf = PDF::loadView('quotation.pdf', compact($request));
//        $pdfPath = public_path('quotations/' . $request->id . '.pdf');
//        $pdf->save($pdfPath);
        $quotation = [
            'tilte' => $request->project,
            'description' => $request->type
        ];
        $pdf = PDF::loadView('quotation.pdf',compact('quotation'));
        return $pdf->download('pdfview.pdf');
        return $pdf->stream();
//
//        return Redirect::route('quotations.index');
    }

    public function view(Request $request)
    {
        $pdf = PDF::loadView('quotation.pdf',compact('request'));
//        return $pdf->download('pdfview.pdf');
        return $pdf->stream();
    }

    public function download(Quotation $quotation)
    {
        $pdfPath = public_path('quotations/' . $quotation->id . '.pdf');

        return Response::download($pdfPath, 'quotation.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
