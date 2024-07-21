<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OTPController extends Controller
{
    public function show()
    {
        return view('otp.show');
    }

    public function sendOTP(Request $request)
    {
        $otp = rand(1000, 9999); // Generate a random OTP (you may use a more secure method)

        // Store OTP in session
        Session::put('otp', $otp);

        // Send OTP via SMS or email (implement your logic here)

        // For example, send via email (make sure to set up mail configuration in .env)
        \Mail::to($request->email)->send(new \App\Mail\SendOTPMail($otp));

        return redirect()->route('otp.show')->with('success', 'OTP has been sent to your email.');
    }

    public function verifyOTP(Request $request)
    {
        $otp = Session::get('otp');

        if ($request->otp == $otp) {
            // OTP matched, proceed with your logic (e.g., login user)
            return redirect()->route('dashboard')->with('success', 'OTP verified successfully.');
        } else {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }
    }
}

?>