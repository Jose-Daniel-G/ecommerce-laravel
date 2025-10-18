<x-app-layout>
    <div class="pt-12 max-w-4xl mx-auto">
        <img class="w-full" src="{{ asset('img/gracias-por-tu-compra.png') }}" alt="Gracias">
        @if (session('niubiz'))
            @php
                $response = session('niubiz')['response'];
            @endphp
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 mt-8"
                role="alert">
                <span class="font-medium">
                    <p class="mb-4">{{ $response['dataMap']['ACTION_DESCRIPTION'] }}</p>
                    <p> <b> Numero de pedido</b>{{ $response['order']['purchaseNumber'] }}</p>
                    <p> <b> Fecha y hora del pedido</b>{{ now()->createFromFormat('ymdHis',$response['dataMap']['TRANSACTION_DATE'])->format('d-m-Y H:i:s') }}</p>
                    <p> <b>Tarjeta:</b>{{ $response['order']['CARD'] }}{{ $response['dataMap']['BRAND'] }}</p>
                    <p> <b>Importe:</b>{{ $response['order']['amount'] }}{{ $response['dataMap']['currency'] }}</p>
            </div>
        @endif
    </div>
</x-app-layout>
