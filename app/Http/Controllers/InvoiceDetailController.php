<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        $products = Product::all();
        $details = InvoiceDetail::where('invoice_id', $invoice->id)->get();

        return view('invoices.add_products', compact('products', 'invoice', 'details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'invoice_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ]);
        $data = $request->only(['product_id', 'invoice_id', 'price', 'quantity']);
        if ($data['price'] !== "") {
            $data['price'] = Product::find($data['product_id'])->price;
        }
        $data['total_product'] = $data['price'] * $data['quantity'];
        InvoiceDetail::create($data);
        return redirect()->route('invoices.add_products', ['invoice' => $data['invoice_id']])->with(['status' => 'Success', 'color' => 'green', 'message' => 'Creado exitosamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceDetail $invoiceDetail)
    {
        //
    }
}
