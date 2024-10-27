<?php

namespace App\Http\Controllers;

use App\Mail\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NoticeController extends Controller
{
    public function notice()
    {
        $recipients = User::select(['name', 'email'])->get();

        return view('/adminpage/notice', [
            'recipients' => $recipients,
        ]);
    }

    public function noticeSend(Request $request)
    {
        Mail::to($request->recipient)->send(new Notice($request));

        return redirect('adminpage');
    }
}
