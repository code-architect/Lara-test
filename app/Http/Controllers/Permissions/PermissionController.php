<?php

namespace App\Http\Controllers\Permissions;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

//        $user->updatePermissions(['edit post', 'delete post']);
//        return new Response('hello', 200);
        echo "Hello Admin";
    }

    public function user(Request $request)
    {
        //$user = $request->user();

        return view('backend.admin.edit');
    }
}
