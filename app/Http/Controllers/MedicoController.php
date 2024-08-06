<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::all();
        return view('admin.medicos.index',[
            'medicos' => $medicos
        ]);
    }

    public function create()
    {
        return view('admin.medicos.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'curp' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'password' => 'required',
            'especialidad' => 'required',
            'cedula' => 'required',
            'direccion' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->curp = $request->curp;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $medico = new Medico();
        $medico->user_id = $user->id;
        $medico->especialidad = $request->especialidad;
        $medico->cedula = $request->cedula;
        $medico->direccion = $request->direccion;
        $medico->save();
        
        return redirect()->route('medico.index');
    }

    public function show(Medico $medico)
    {
        return view('admin.medicos.show',[
            'medico' => $medico
        ]);
    }

    public function edit(Medico $medico)
    {
        return view('admin.medicos.edit',[
            'medico' => $medico
        ]);
    }

    public function update(Request $request, Medico $medico)
    {

        $request->validate([
            'name' => 'required',
            'curp' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'especialidad' => 'required',
            'cedula' => 'required',
            'direccion' => 'required',
        ]);

        
        $medico->especialidad = $request->especialidad;
        $medico->cedula = $request->cedula;
        $medico->direccion = $request->direccion;
        $medico->save();

        $user = $medico->user;
        $user->name = $request->name;
        $user->curp = $request->curp;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->save();
        
        return redirect()->route('medico.index');
    }

    public function destroy(Medico $medico)
    {
        $medico->delete();
        return redirect()->route('medico.index');
    }


}
