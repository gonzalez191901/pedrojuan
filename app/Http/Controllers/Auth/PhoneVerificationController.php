<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Twilio\Rest\Client;

class PhoneVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedPhone() 
            ? redirect()->route('home')
            : view('auth.verify-phone');
    }

    public function verify(Request $request)
    {
        if ($request->user()->verification_code !== $request->code) {
            return back()->withErrors(['code' => 'El código de verificación es incorrecto']);
        }

        if ($request->user()->hasVerifiedPhone()) {
            return redirect()->route('home');
        }

        $request->user()->markPhoneAsVerified();

        return redirect()->route('home')->with('status', 'Tu teléfono ha sido verificado!');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedPhone()) {
            return redirect()->route('home');
        }

        $verification_code = rand(1000, 9999);
        $request->user()->update(['verification_code' => $verification_code]);

        // Enviar SMS con Twilio
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        
        $message = $twilio->messages->create(
            $request->user()->telefono,
            [
                'from' => env('TWILIO_FROM'),
                'body' => 'Tu código de verificación es: ' . $verification_code
            ]
        );

        return back()->with('status', 'Hemos enviado un nuevo código de verificación a tu teléfono');
    }
}