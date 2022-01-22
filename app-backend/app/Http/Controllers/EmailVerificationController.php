<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request) {
        if($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email is already verified!'
            ];
        }

        $request->user()->sendEmailVerificationNotification();

        return [
            'status' => 'verification-link-sent'
        ];
    }

    public function verify(EmailVerificationRequest $request) {
        if($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email is already verified!'
            ];
        }

        if($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return [
            'status' => 'Email has been verified!'
        ];
    }
}
