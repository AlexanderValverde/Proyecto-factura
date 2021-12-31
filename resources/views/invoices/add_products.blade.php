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
                {{ __('Facturas') }} {{ $invoice->id }}
            </h2>
        </x-slot>
    
        <div class="py-12">
    
    
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="{{ route('invoices.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800 focus:outline-none focus:border-gray-800 focus:ring focus:ring-gray-200 disabled:opacity-25 transition mb-4">
                    {{ __('Listado de Facturas') }}
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
    
                <div class="overflow-hidden sm:rounded-lg">
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
                                                <th class="py-3 px-6 text-center">Buyer</th>
                                                <th class="py-3 px-6 text-center">Status</th>
                                                <th class="py-3 px-6 text-center">Created at</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 text-sm font-light">
    
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
    
    
                                            </tr>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="grid gap-8 grid-cols-1" action="{{ route('invoice-details.store') }}" method="POST">
                        <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
                        @csrf
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
    
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <label for="nif" class="block text-sm font-medium text-gray-700">
                                            Product
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <select name="product_id"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                                <option value="">Seleccione Uno</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}
                                                    ({{ $product->price }}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('nif')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
    
                                    <div>
                                        <label for="quantity" class="block text-sm font-medium text-gray-700">
                                            Quantity
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                        </div>
                                        @error('quantity')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
    
    
                                    <div>
                                        <label for="price" class="block text-sm font-medium text-gray-700">
                                            Precio (Leave blank to not modify)
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="price" id="price" value="{{ old('price') }}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                        </div>
                                        @error('price')
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
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
    
                    <div class="w-full">
                        <div class="bg-white rounded my-2">
                            <div class="overflow-x-auto">
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight px-5 py-5">Details invoice
                                </h3>
                                <div
                                    class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                                    <div class="w-full">
                                        <div class="bg-white shadow-md rounded my-6">
                                            <table class="min-w-max w-full table-auto">
                                                <thead>
                                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                        <th class="py-3 px-6 text-left">#Id</th>
                                                        <th class="py-3 px-6 text-left">Product</th>
                                                        <th class="py-3 px-6 text-center">Price</th>
                                                        <th class="py-3 px-6 text-center">Quantity</th>
                                                        <th class="py-3 px-6 text-center">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 text-sm font-light">
                                                    @php
                                                    $total= 0;
                                                    @endphp
                                                    @foreach ($details as $item)
    
                                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <span
                                                                    class="font-medium">{{ str_pad($item->id, 4,0, STR_PAD_LEFT)  }}</span>
                                                            </div>
                                                        </td>
    
                                                        <td class="py-3 px-6 text-left">
                                                            <div class="flex items-center">
                                                                <span>{{ $item->product->name }}</span>
                                                            </div>
                                                        </td>
    
                                                        <td class="py-3 px-6 text-center">
                                                            <span>{{ $item->price }}</span>
                                                        </td>
    
                                                        <td class="py-3 px-6 text-center">
                                                            <span>{{ $item->quantity }}</span>
                                                        </td>
    
                                                        <td class="py-3 px-6 text-center">
                                                            <span>{{ $item->total_product }}</span>
                                                        </td>
    
                                                    </tr>
    
                                                    @php
                                                    $total = $total + $item->total_product;
                                                    @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="4" class="py-3 px-6 text-left whitespace-nowrap">
                                                            Total Invoice
                                                        </td>
                                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                                            {{ $total }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" text-right">
    
                            <form method="POST" action="{{ route('invoices.complete', ['invoice'=> $invoice->id]) }}">
                                @csrf
                                <a href="{{ route('invoices.complete', ['invoice'=> $invoice->id]) }}" onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                                    {{ __('Complete and send') }}
    
                                </a>
                            </form>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>