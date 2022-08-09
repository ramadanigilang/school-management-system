<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function ViewYear()
    {
        $data['allData'] = StudentYear::all();
        return view('backend.setup.year.view_Year', $data);
    }

    public function StudentYearAdd()
    {

        return view('backend.setup.year.add_Year');
    }

    public function StudentYearStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',

        ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.year.view');
    }

    public function StudentYearEdit($id)
    {
        $editData = StudentYear::find($id);
        return view('backend.setup.year.edit_year', compact('editData'));
    }

    public function StudentYearUpdate(Request $request, $id)
    {

        $data = StudentYear::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name,' . $data->id,

        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.year.view');
    }

    public function StudentYearDelete($id)
    {
        $user = StudentYear::find($id);
        $user->delete();

        return redirect()->route('student.year.view');
    }
}
