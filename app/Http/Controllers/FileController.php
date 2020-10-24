<?php

namespace App\Http\Controllers;

use App\Models\Obj;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $user_id = $request->user()->company->id;

        $object = Obj::forCurrentCompany()->where(
            'uuid', $request->get('uuid', Obj::forCurrentCompany()
            ->whereNull('parent_id')->first()->uuid))
            ->firstOrFail();

        //dd($object->children);

        return view('files', [
            'object' => $object
        ]);
    }
}
