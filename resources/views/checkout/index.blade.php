<x-app-layout>
    <div class="-mb-16 text-gray-700" x-data="{ pago: 1 }">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="col-span-1 bg-white">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <h1 class="mb-2">
                        <div class="text-2xl font-semibold">Pago</div>
                    </h1>
                    <div class="shadow rounded-lg overflow-hidden border border-gray-400">
                        <ul class="divide-y divide-gray-400">
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="1">
                                    <span class="ml-2">Tarjeta de debito / credito</span>
                                    <img class="h-6 ml-auto" src="{{ asset('img/credit-cards.png') }}" alt="">
                                </label>
                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400" x-cloak
                                    x-show="pago==1">
                                    <i class="fa-regular fa-credit-card text-9xl"></i>
                                    <p class="mt-2">Luego de hacer click en "Pagar ahora", se abrira el checkout de
                                        Niubiz para completar tu compra de forma segura</p>
                                </div>
                            </li>
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="2">
                                    <span class="ml-2">Deposito Bancario o Yape</span>
                                </label>
                                <div class="p-4 bg-gray-100 flex justify-center border-t border-gray-400"
                                    x-show="pago==2">
                                    <div>
                                        <p>1. pago por deposito o tranferencia bancarai</p>
                                        <p>- BCP pesos: 159-866545321-18</p>
                                        <p>- CCI: 002-866545321</p>
                                        <p>- Razon social: Ecommerce J.D.G</p>
                                        <p>- RUC: 2356493321</p>
                                        <p>2. Pago por Yape</p>
                                        <p>- Yape al numero 986 654 321 (Ecommerce J.D.G)</p>
                                        <p> Enviar el comprobante a 986 654 321</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <ul class="space-y-4 mb-4">
                        @foreach (Cart::instance('shopping')->content() as $item)
                            <li class="flex items-center space-x-4">
                                <div class="flex-shrink-0 relative">
                                    <img class="h-16 aspect-square" src="{{ $item->options->image }}" alt="">
                                    <div
                                        class="flex justify-center items-center h-6 w-6 bg-gray-900 bg-opacity-70 rounded-full absolute -right-2 -top-2">
                                        <span class="text-white font-semibold">{{ $item->qty }}</span>
                                    </div>

                                </div>
                                <div class="flex-1">
                                    <p>{{ $item->name }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p>${{ $item->price }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-between">
                        <p>Subtotal</p>
                        <p>{{ Cart::instance('shopping')->subtotal() }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Precio envio<i class="fas fa-info-circle" title="El precio de envio es de 5200 pesos"></i>
                        </p>
                        <p>$ 5200</p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between mb-4">
                        <p class="text-lg font-semibold">Total</p>
                        <p> {{ (float) str_replace(',', '', Cart::instance('shopping')->subtotal()) + 5 }}$</p>
                    </div>
                    <div>
                        <button onclick="VisanetCheckout.open()" class="btn btn-blue w-full">Finalizar pedido</button>
                        {{-- @dump(session('niubiz')) --}}

                        @if (session('niubiz'))
                            @php
                                $niubiz = session('niubiz');
                                $response = $niubiz['niubiz'];
                                $purchaseNumber = $niubiz['purchaseNumber'];
                            @endphp
                            @isset($response['data'])
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 mt-8"
                                    role="alert"> 
                                    <p class="mt-4">{{$response['data']['ACTION_DESCRIPTION']}}</p>
                                    <p><b>Numero de pedido</b>{{$purchaseNumber}}</p>
                                    <p> <b> Fecha y hora del pedido</b>{{ now()->createFromFormat('ymdHis',$response['data']['TRANSACTION_DATE'])->format('d-m-Y H:i:s') }}</p>
                                    @isset($response['data']['CARD'])
                                    <p> <b>Tarjeta:</b>{{ $response['data']['CARD'] }}{{ $response['data']['BRAND'] }}</p>
                                        
                                    @endisset

                                </div>
                            @endisset
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}"></script>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                let purchaseNumber = Math.floor(Math.random() * 1000000000);
                let amount = {{Cart::instance('shopping')->subtotal()}};
                VisanetCheckout.configure({
                    sessiontoken: "{{ $session_token }}",
                    channel: "web",
                    merchantid: "{{ config('services.niubiz.merchant_id') }}",
                    purchasenumber: purchaseNumber,
                    amount: amount,
                    expirationminutes: "20",
                    timeouturl: "about:blank",
                    merchantlogo: "{{ asset('img/comercio.png') }}",
                    formbuttoncolor: "#000000",
                    action: "{{route('checkout.paid')}}?amount=" + amount + "&purchasenumber=" + purchaseNumber,
                    complete: function(params) {
                        console.log('Transacción completada:', params);
                        alert("Pago finalizado correctamente");
                    }
                });
            })
        </script>
    @endpush
</x-app-layout>
