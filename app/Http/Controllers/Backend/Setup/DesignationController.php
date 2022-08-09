<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Desination;

class DesignationController extends Controller
{
    public function ViewDesignation()
    {
        $data['allData'] = Desination::all();
        return view('backend.setup.designation.view_designation', $data);
    }

    public function DesignationAdd()
    {
        return view('backend.setup.designation.add_designation');
    }

    public function DesignationStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:desinations,name',
        ]);

        $data = new Desination();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('designation.view');
    }

    public function DesignationEdit($id)
    {
        $editData = Desination::find($id);
        return view('backend.setup.designation.edit_designation', compact('editData'));
    }

    public function DesignationUpdate(Request $request, $id)
    {

        $data = Desination::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:desinations,name,' . $data->id,

        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('designation.view');
    }

    public function DesignationDelete($id)
    {
        $user = Desination::find($id);
        $user->delete();

        return redirect()->route('designation.view');
    }
}
