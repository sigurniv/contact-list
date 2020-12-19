<?php

namespace App\Http\Controllers;


class ApiController extends Controller
{
    public function respond($data, $errors = [])
    {
        $response = response()->json([
            'data'   => $data,
            'errors' => $errors
        ]);

        if (!empty($errors)) {
            $response->setStatusCode(400);
        }

        return $response;
    }
}
