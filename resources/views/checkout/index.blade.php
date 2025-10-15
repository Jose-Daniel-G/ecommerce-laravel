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
                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400" x-cloak x-show="pago==1">
                                    <i class="fa-regular fa-credit-card text-9xl"></i>
                                    <p class="mt-2">Luego de hacer click en "Pagar ahora", se abrira el checkout de Niubiz para completar tu compra de forma segura</p>
                                </div>
                            </li>
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="2">
                                    span.ml-2{Deposito Bancario o Yape}
                                </label>
                                <div class="p-4 bg-gray-100 flex-justify-center border-t border-gray-400" x-show="pago==2">
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

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime quam odio, pariatur ab neque
                        laborum
                        at repellat magni? Distinctio eveniet sapiente veritatis neque optio. Maxime tempora ratione ut
                        consectetur corporis.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
