<div>
    <div
        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

        <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
            Sustitución mono-alfabetica
        </h1>

        <p class="mt-4 text-gray-600 dark:text-gray-400">
            El cifrado de sustitución mono-alfabética es un cifrado de sustitución en el que cada letra del texto
            plano es reemplazada por otra letra, siempre que sea la misma letra. Por ejemplo, la letra A puede
            ser reemplazada por la letra Q. El cifrado mono-alfabético contrasta con el cifrado poli-alfabético,
            que utiliza un alfabeto de sustitución que cambia en el transcurso del mensaje.
        </p>

        <div class="grid grid-cols-12">
            <div class="col-span-12 md:col-span-6">
                {{-- Cifrado --}}
                <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">Cifrado</h1>
                <div class="mt-6">
                    <div class="flex flex-col lg:flex-row">
                        <div class="w-full lg:w-1/2">
                            <div class="flex flex-col">
                                <label for="text"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Texto
                                </label>
                                <div class="mt-1">
                                    <textarea wire:model="mensajeSinCifrar" id="text" name="text" rows="3"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200 rounded-md"></textarea>
                                    @error('mensaje')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 lg:pl-4 mt-4 lg:mt-0">
                            <div class="flex flex-col">
                                <label for="key"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Clave 
                                </label>
                                <div class="mt-1">
                                    <input wire:model="claveSinCifrar" type="text" name="key" id="key"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200 rounded-md">
                                    @error('claveSinCifrar')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/3 bg-green-200 lg:pl-4 mt-4 lg:mt-0">
                            <div class="flex flex-col space-y-5">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Texto cifrado: {{ "".$mensajeCifradoResultado."" }}
                                </label>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 lg:pl-4 mt-4 lg:mt-0">
                            <x-button wire:click="cifrar" class="mt-4">
                                {{ __('Cifrar') }}
                            </x-button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6">
                {{-- Descifrado --}}
                <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">Descifrado</h1>
                <div class="mt-6">
                    <div class="flex flex-col lg:flex-row">
                        <div class="w-full lg:w-1/2">
                            <div class="flex flex-col">
                                <label for="text"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Texto cifrado
                                </label>
                                <div class="mt-1">
                                    <textarea wire:model="mensajeCifrado" id="mensajeCifrado" name="mensajeCifrado" rows="3"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200 rounded-md"></textarea>
                                    @error('mensaje')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 lg:pl-4 mt-4 lg:mt-0">
                            <div class="flex flex-col">
                                <label for="key"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Clave
                                </label>
                                <div class="mt-1">
                                    <input wire:model="claveCifrado" type="text" name="tamanioGrupo" id="claveCifrado"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200 rounded-md">
                                    @error('claveCifrado')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/3 bg-green-200 lg:pl-4 mt-4 lg:mt-0">
                            <div class="flex flex-col space-y-5">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Texto descifrado: {{ $mensajeDescifradoResultado }}
                                </label>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 lg:pl-4 mt-4 lg:mt-0">
                            <x-button wire:click="descifrar" class="mt-4">
                                {{ __('Descifrar') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
