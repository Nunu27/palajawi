<x-dashboard-layout>
    {{-- TODO: UI Dashboard --}}
    <div class="grid gap-4 gap-y-2 sm:grid-cols-2 lg:grid-cols-4">
        <x-card.stat name="Pengguna" value="100.000" icon="gmdi-people-outline" :diff="5.0" />
        <x-card.stat name="Transaksi" value="100.000" icon="gmdi-receipt-long-r" :diff="-2.1" />
        <x-card.stat name="Ulasan" value="100.000" icon="gmdi-rate-review-o" />
        <x-card.stat name="tes" value="100.000" icon="gmdi-people-outline" />
    </div>
</x-dashboard-layout>
