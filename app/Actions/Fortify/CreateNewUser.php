<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Paciente;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:255'],
            'curp' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'sexo' => ['required', 'string'],
            'tipo_sangre' => ['required', 'string', 'max:3'],
            'alergias' => ['required', 'string', 'max:255'],
            'enfermedades_cronicas' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Crear el usuario
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'curp' => $input['curp'],
            'password' => Hash::make($input['password']),
            'telefono' => $input['telefono'],
        ]);

        // Crear el paciente asociado
        Paciente::create([
            'user_id' => $user->id,
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'sexo' => $input['sexo'],
            'tipo_sangre' => $input['tipo_sangre'],
            'alergias' => $input['alergias'],
            'enfermedades_cronicas' => $input['enfermedades_cronicas'],
        ]);

        return $user;
    }
}


// Schema::create('users', function (Blueprint $table) {
//     $table->id();
//     $table->string('name');
//     $table->string('curp');
//     $table->string('telefono');
//     $table->string('email')->unique();
//     $table->timestamp('email_verified_at')->nullable();
//     $table->string('password');
//     $table->rememberToken();
//     $table->foreignId('current_team_id')->nullable();
//     $table->string('profile_photo_path', 2048)->nullable();
//     $table->timestamps();
// });

// Schema::create('pacientes', function (Blueprint $table) {
//     $table->id();
//     $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
//     $table->date('fecha_nacimiento');
//     $table->string('sexo');
//     $table->string('tipo_sangre');
//     $table->string('alergias');
//     $table->string('enfermedades_cronicas');
//     $table->timestamps();
// });