<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\EmployeeCreated;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller{
  /**
   * Display a listing of the resource.
   */
  public function index(){
    $employees = User::query()
      ->where('role', '1')
      ->orderBy('users.created_at')
      ->get();
    return view('employees.index', [
      'employees' => $employees
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(){
    return view('employees.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request){
    $employee = new User();
    $employee->name = $request->name;
    $employee->email = $request->email;
    $employee->password = Hash::make($request->password);
    $employee->role = '1';

    $employee->save();
    Mail::to($request->email)->send(new EmployeeCreated($request->email, $request->password));
    return redirect()
      ->route('employee.index')
      ->with('success', 'Сотрудник успешно создан');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id){
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id){
    $employee = User::find($id);

    if(!$employee){
      return redirect()
        ->route('employee.index')
        ->withErrors('Такого сотрудника не существует');
    }

    return view('employees.edit', compact('employee'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, string $id){
    $employee = User::find($id);

    if(!$employee){
      return redirect()
        ->route('employee.index')
        ->withErrors('Такого сотрудника не существует');
    }

    $employee->name = $request->name;
    $employee->email = $request->email;
    $employee->password = Hash::make($request->password);

    $employee->update();
    return redirect()
      ->route('employee.index')
      ->with('success', 'Сотрудник успешно отредактирован');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id){
    $employee = User::find($id);

    if(!$employee){
      return redirect()
        ->route('employee.index')
        ->withErrors('Такого сотрудника не существует');
    }

    $employee->delete();

    return redirect()->route('employee.index');
  }
}