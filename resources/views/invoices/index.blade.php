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
                {{ __('Facturas') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
    
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="{{ route('invoices.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                    {{ __('Agregar Nueva Factura') }}
                </a>
            </div>
    
    
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session('status'))
                <div class="relative py-3 pl-4 pr-10 leading-normal text-{{ session('color') }}-700 bg-{{ session('color') }}-100 rounded-lg"
                    role="alert">
                    <p>{{ session('message') }}</p>
                    <span class="absolute inset-y-0 right-0 flex items-center mr-4">
                        <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
                @endif
    
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    
                    <div class="overflow-x-auto">
                        <div
                            class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                            <div class="w-full">
                                <div class="bg-white shadow-md rounded my-6">
                                    <table class="min-w-max w-full table-auto">
                                        <thead>
                                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                <th class="py-3 px-6 text-left">#Id</th>
                                                <th class="py-3 px-6 text-left">Serie</th>
                                                <th class="py-3 px-6 text-center">Comprador</th>
                                                <th class="py-3 px-6 text-center">Status</th>
                                                <th class="py-3 px-6 text-center">Created at</th>
                                                <th class="py-3 px-6 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 text-sm font-light">
                                            @foreach ($invoices as $invoice)
                                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span
                                                            class="font-medium">{{ str_pad($invoice->id, 4,0, STR_PAD_LEFT)  }}</span>
                                                    </div>
                                                </td>
    
                                                <td class="py-3 px-6 text-left">
                                                    <div class="flex items-center">
                                                        <span>{{ $invoice->serie }}</span>
                                                    </div>
                                                </td>
    
                                                <td class="py-3 px-6 text-center">
                                                    <span>{{ $invoice->buyer->name }}</span>
                                                </td>
    
                                                <td class="py-3 px-6 text-center">
                                                    <span>{{ $invoice->status }}</span>
                                                </td>
    
                                                <td class="py-3 px-6 text-center">
                                                    <span>{{ $invoice->created_at }}</span>
                                                </td>
    
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex item-center justify-center">
                                                        <div
                                                            class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                            <a
                                                                href={{ route('invoices.add_products', ['invoice'=> $invoice->id]) }}>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                    <path
                                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                                </svg>
                                                                </svg>
                                                            </a>
                                                        </div>
    
    
                                                        {{-- Edit --}}
                                                        <div
                                                            class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
    
                                                            <a
                                                                href={{ route('invoices.edit', ['invoice'=> $invoice->id]) }}>
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                </svg>
                                                            </a>
                                                        </div>
    
                                                        <div
                                                            class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                            <form method="POST"
                                                                action="{{ route('invoices.destroy', ['invoice'=> $invoice->id]) }}">
                                                                @csrf
                                                                {{  method_field("DELETE") }}
    
                                                                <a href="{{ route('invoices.destroy', ['invoice'=> $invoice->id]) }}"
                                                                    onclick="event.preventDefault();
                                                                                this.closest('form').submit();">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                </a>
                                                            </form>
    
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>