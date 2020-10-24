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

        $object = Obj::with('children.objectable', 'ancestorsAndSelf.objectable')->forCurrentCompany()->where(
            'uuid', $request->get('uuid', Obj::forCurrentCompany()
            ->whereNull('parent_id')->first()->uuid))
            ->firstOrFail();

        return view('files', [
            'object' => $object,
            'ancestors' => $object->ancestorsAndSelf()->breadthFirst()->get()
        ]);
    }
}
