<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class VerificationController extends Controller
{
    public function index()
    {
        return view('fitur_verifikasi.index');
    }

    public function show($unique_id)
    {
        $verify = Verification::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)
            ->wherestatus('active')->count();
        if (! $verify) {
            abort(404);
        }

        return view('fitur_verifikasi.show', compact('unique_id'));
    }

    public function update(Request $request, $unique_id)
    {
        $verify = Verification::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)
            ->wherestatus('active')->first();
        if (! $verify) {
            abort(404);
        }
        if (md5($request->otp) != $verify->otp) {
            $verify->update(['status' => 'invalid']);

            return redirect('/verify');
        }
        $verify->update(['status' => 'valid']);
        User::find($verify->user_id)->update(['status' => 'active']);

        return redirect()->route('landingpage');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', Rule::in(['register'])],
        ]);

        if ($validated['type'] === 'register') {
            $user = User::find($request->user()->id);
        }

        if (! $user) {
            return back()->with('failed', 'User not found');
        }

        Verification::where('user_id', $user->id)
            ->where('type', $validated['type'])
            ->where('status', 'active')
            ->update(['status' => 'invalid']);

        $otp = rand(100000, 999999);
        $verify = Verification::create([
            'user_id' => $user->id,
            'unique_id' => uniqid(),
            'otp' => md5($otp),
            'type' => $validated['type'],
            'send_via' => 'email',
            'status' => 'active',
        ]);
        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect('/verify/'.$verify->unique_id);
    }
}
