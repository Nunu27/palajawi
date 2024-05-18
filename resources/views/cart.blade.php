<x-app-layout title="Keranjang">
    {{-- TODO: Keranjang UI --}}
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-lg px-4 md:px-8">
            <div class="mb-6 sm:mb-10 lg:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Your Cart</h2>
            </div>

            <div class="mb-6 flex flex-col gap-4 sm:mb-8 md:gap-6">
                <!-- product - start -->
                <x-card.chekout>
                    <x-slot name="nama">Umbi</x-slot>
                </x-card.chekout>
                <x-card.chekout>
                    <x-slot name="nama">Kacang</x-slot>
                </x-card.chekout>
                <x-card.chekout>
                    <x-slot name="nama">jagung</x-slot>
                </x-card.chekout>
                <!-- product - end -->

            </div>

            <!-- totals - start -->
            <div class="flex flex-col items-end gap-4">
                <div class="w-full rounded-lg bg-gray-100 p-4 sm:max-w-xs">
                    <div class="space-y-1">
                        <div class="flex justify-between gap-4 text-gray-500">
                            <span>Total Pesanan</span>
                            <span>3</span>
                        </div>
                    </div>

                    <div class="mt-4 border-t pt-4">
                        <div class="flex items-start justify-between gap-4 text-gray-800">
                            <span class="text-lg font-bold">Total Bayar</span>

                            <span class="flex flex-col items-end">
                                <span class="text-lg font-bold">Rp 134.000</span>
                            </span>
                        </div>
                    </div>
                </div>

                <button
                    class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">Check
                    out</button>
            </div>
            <!-- totals - end -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addButton').addEventListener('click', function() {
                var quantity = parseInt(document.getElementById('quantity').textContent);
                quantity = quantity + 1;
                document.getElementById('quantity').textContent = quantity;
            });

            document.getElementById('subtractButton').addEventListener('click', function() {
                var quantity = parseInt(document.getElementById('quantity').textContent);
                if (quantity > 0) {
                    quantity = quantity - 1;
                    document.getElementById('quantity').textContent = quantity;
                }
            });

            document.getElementById('deleteButton').addEventListener('click', function() {
                var quantity = parseInt(document.getElementById('quantity').textContent);
                quantity = 0;
                document.getElementById('quantity').textContent = quantity;
            });
        });
    </script>


</x-app-layout>
