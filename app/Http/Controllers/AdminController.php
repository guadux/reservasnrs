<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }
    public function log()
    {
        $pathToFile = storage_path("logs/reservas.log");

        $name = time().'.txt';

        $headers = ['Content-Type: application/octet-stream'];

        return response()->download($pathToFile, $name, $headers);

    }

}
