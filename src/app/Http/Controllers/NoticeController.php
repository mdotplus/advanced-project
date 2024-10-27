<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function notice()
    {
        $recipients = User::select(['name', 'email'])->get();

        return view('/adminpage/notice', [
            'recipients' => $recipients,
        ]);
    }

    public function noticeSend()
    {
    }
}
