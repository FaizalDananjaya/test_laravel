<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Outmessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.index', [
            'employees' => Employee::with(['category'])->latest()->filter(request(['search']))->paginate(10)->withQueryString(),
            'jobs' => Category::where('tabel_id', '8')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create', [
            'jobs' => Category::where('tabel_id', '8')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:200',
            'jk' => 'required',
            'category_id' => 'required',
            'no_telp' => 'required|max:20',
            'email' => 'nullable|email',
            'image' => 'image|file|max:1024',
            'alamat' => 'nullable|max:200'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('employee-image');
        }

        Employee::create($validatedData);
        return redirect('/formulir/employees')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.employee.edit', [
            'employ' => $employee,
            'jobs' => Category::where('tabel_id', '8')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:200',
            'jk' => 'required',
            'category_id' => 'required',
            'no_telp' => 'required|max:20',
            'email' => 'nullable|email',
            'image' => 'image|file|max:1024',
            'alamat' => 'nullable|max:200'
        ]);

        $query = Employee::where('id', $employee->id);

        if ($request->file('image')) {
            if ($query->image) {
                Storage::delete($query->image);
            }
            $validatedData['image'] = $request->file('image')->store('employee-image');
        }

        Employee::where('id', $employee->id)
            ->update($validatedData);
        return redirect('/formulir/employees')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if (
            Outmessage::where('employee_id', '=', $employee->id)->count() > 0 ||
            User::where('employee_id', '=', $employee->id)->count() > 0 ||
            Post::where('employee_id', '=', $employee->id)->count() > 0
        ) {
            return redirect('/formulir/employees')->with('fail', 'Data gagal dihapus karena masih terdapat data lain yang terhubung dengan data Karyawan ini');
        }

        $query1 = Employee::where('id', $employee->id)->first();

        if ($query1->image) {
            Storage::delete($query1->image);
        }

        Employee::destroy($employee->id);
        return redirect('/formulir/employees')->with('success', 'Data berhasil dihapus');
    }
}
