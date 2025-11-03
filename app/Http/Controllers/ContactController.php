<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Service;

class ContactController extends Controller
{
    /**

     */
    public function send(Request $request)
    {

        $validated = $request->validate([
            'message_title' => 'required|string|max:200',
            'name'       => 'required|string|max:100',
            'phone'      => 'required|string|max:20',
            'email'      => 'nullable|email|max:100',
            'company'    => 'nullable|string|max:150',
            'service_id' => 'nullable|integer',
            'location'   => 'nullable|string|max:100',
            'needs'      => 'required|string',
        ]);

        // ✅ Ambil nama service berdasarkan ID
        if (!empty($validated['service_id'])) {
            $service = Service::find($validated['service_id']);
            $validated['service_name'] = $service ? $service->name : '-';
        } else {
            $validated['service_name'] = '-';
        }

        try {
            // ✅ Kirim email ke admin
            Mail::to('deva.adzany00@gmail.com')->send(new ContactMail($validated));

            return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Gagal mengirim pesan. Silakan coba lagi beberapa saat.');
        }
    }

    /**

     */
    public function index()
    {
        return view('visitor.contact');
    }
}
