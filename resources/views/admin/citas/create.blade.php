<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Cita Médica') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <form method="POST" action="{{ route('citamedica.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Paciente -->
                            <div>
                                <label for="paciente_id" class="block text-sm font-medium text-gray-700">Paciente</label>
                                <select id="paciente_id" name="paciente_id" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Seleccionar paciente</option>
                                    @foreach($pacientes as $paciente)
                                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido_paterno }} {{ $paciente->apellido_materno }}</option>
                                    @endforeach
                                </select>
                                @error('paciente_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Médico -->
                            <div>
                                <label for="medico_id" class="block text-sm font-medium text-gray-700">Médico</label>
                                <select id="medico_id" name="medico_id" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Seleccionar médico</option>
                                    @foreach($medicos as $medico)
                                        <option value="{{ $medico->id }}">{{ $medico->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('medico_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hora de inicio -->
                            <div>
                                <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora de Inicio</label>
                                <input type="datetime-local" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('hora_inicio')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Estado -->
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                                <select id="estado" name="estado" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Seleccionar estado</option>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="confirmado">Confirmado</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                                @error('estado')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Motivo -->
                            <div>
                                <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo</label>
                                <textarea name="motivo" id="motivo" rows="3" required
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('motivo') }}</textarea>
                                @error('motivo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Guardar
                                </button>
                                <a href="{{ route('citamedica.index') }}" class="ml-4 text-blue-500 hover:text-blue-700">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
