<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        
        $employee = Employee::select('id','employee_id','fullname','group_company','work_area_code','designation')->where('id', $user)->first();

        $files = File::where('group_company', $employee->group_company)->get();

        $uploadFile = in_array($employee->designation, ['HCIS Developer (CRP_HO_HC_DSG012)', 'HC Information System Department Head (KPN_DES38)', 'SOP Specialist (PLT_DES1002)']);

        return view('files.index', compact('files', 'uploadFile'));
    }

    public function create()
    {

        $user = Auth::user()->id;

        $data = Employee::select('id','employee_id','fullname','group_company','work_area_code')->where('id', $user)->first();

        return view('files.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|mimes:pdf|max:10240',
            'fileName' => 'required|string|min:5',
            'description' => 'required|string|min:5'
        ]);
        
        $fileName = $validatedData['fileName'];
        $description = $validatedData['description'];
        $groupCompany = $request->groupCompany;

        $existingFile = File::where('name', $fileName)->first();
        if ($existingFile) {
            return back()->withErrors(['fileName' => 'File with this name already exists.']);
        }

        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $fileName; // $file->getClientOriginalName()
            $path = $file->storeAs('uploads', $filename.'.pdf', 'public');
            $fileSize = $file->getSize();

            $model =  new File;
            $model->name = $fileName;
            $model->description = $description;
            $model->group_company = $groupCompany;
            $model->description = $request->description;
            $model->file_path = $path;
            $model->file_size = $fileSize;
            $model->created_by = Auth::user()->id;
            
            $model->save();
    
            return redirect()->route('files.index')->with('success', 'File uploaded successfully.');
        }

        return back()->withErrors(['files' => 'Please select a file to upload.']);

    }

    public function destroy($id): RedirectResponse

    {
        $file = File::find($id);

        if ($file) {

            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }

            $file->updated_by = Auth::user()->id;
            $file->save();

            $file->delete();
    
            return redirect()->route('files.index')->with('success', 'File deleted successfully!');
        }
        return redirect()->route('files.index')->with('error', 'File not found.');

    }
}
