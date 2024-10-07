<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    use HasFactory;

    public function getAuthorityAttribute($value)
    {
        switch ($value) {
            case 1:
                return '管理者';
                break;
            case 2:
                return '店舗代表者';
                break;
            case 3:
                return '利用者';
                break;
            default:
                return $value;
        }
    }
}
