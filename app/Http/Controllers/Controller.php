<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function successResponse($msg, $data=[])
    {
        return response()->json([
            'status'    => true,
            'data'      => $data,
            'message'   => $msg
            ], 200);

    }
    public function errorResponse($msg='', $status=201)
    {
        return response()->json([
            'status'        => false,
            'message'       => $msg
        ],$status);
    }
}
