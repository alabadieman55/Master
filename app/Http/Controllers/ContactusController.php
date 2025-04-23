<?php

namespace App\Http\Controllers;

use App\Mail\EmailSubmit;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Notifications\NewMessage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showForm()
    {
        return view('contact');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function submitForm(Request $request)
    {
        $data= $request->validate([
   
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|max:255',
            'phone'=>'required|string|max:10',
            'subject'=> 'required|string|max:255',
            'message'=>'required|string'
            
        ]);

        $contact= Contactus::create($data);
        Mail::to('alabadieman58@gmail.com')->send(new EmailSubmit(
              $contact
        ));

        $admins= User::where('Utype','ADM')->get();


        Notification::send($admins, new NewMessage($contact));

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function show(ContactUs $contact)
    {
        // Mark notifications as read when viewing
        auth()->user()->unreadNotifications()
            ->where('data->contact_id', $contact->id)
            ->update(['read_at' => now()]);

        return view('contact.show', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contactus $contactus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contactus $contactus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contactus $contactus)
    {
        //
    }
}
