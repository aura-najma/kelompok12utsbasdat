<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Metode untuk menampilkan halaman invoice
    public function show($id_invoice)
    {
        // Ambil data invoice berdasarkan id_invoice
        $invoice = Invoice::findOrFail($id_invoice);

        // Kirim data ke view
        return view('invoice.show', compact('invoice'));
    }
}
