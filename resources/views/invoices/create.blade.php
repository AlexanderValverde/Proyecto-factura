<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facturas</title>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nueva Factura') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
    
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="{{ route('invoices.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                    {{ __('Listado de Facturas') }}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    
                    <form class="grid gap-8 grid-cols-1" 
                        @if($invoice->id)
                        action="{{ route('invoices.update', ["invoice" => $invoice->id ]) }}" 
                        @else
                        action="{{ route('invoices.store') }}" 
                        @endif enctype="multipart/form-data" method="POST">
                        @if($invoice->id) {{ 
                            method_field("PUT") 
                        }} @endif
    
                        @csrf
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div class="grid gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="buyer_id" class="block text-sm font-medium text-gray-700">
                                            Comprador
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <select name="buyer_id" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                                <option value="">Seleccione uno</option>
                                                @foreach ($buyers as $buyer)
                                                <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('buyer_id')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="grid gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="price" class="block text-sm font-medium text-gray-700">
                                            Serie
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <select name="serie" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                                <option value="">Seleccione uno</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                            </select>
                                        </div>
                                        @error('serie')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Agregar Productos
                                </button>
                            </div>
                        </div>
                    </form>
    
    
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>