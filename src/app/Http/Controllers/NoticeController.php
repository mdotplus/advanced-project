<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
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

    public function noticeSend(NoticeRequest $request)
    {
        if ($request->recipients === 'all') {
            $request->recipients = User::select('email')->get()->toArray();
        }

        foreach ($request->recipients as $recipient) {
            Mail::to($recipient)->send(new Notice($request));
        }

        return redirect('adminpage');
    }
}
