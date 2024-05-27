<?php

use App\Models\Kategori;
use App\Models\Barang;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] #[Title('Beranda')] class extends Component {
    public function with()
    {
        return [
            'kategoriList' => Kategori::all(),
            'barangList' => Barang::latest()->with('kategori')->limit(5)->get(),
        ];
    }
}; ?>

<div>
    <div class="bg-emerald-500 pb-6 sm:pb-8 lg:pb-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <section class="flex flex-col justify-between gap-6 sm:gap-10 md:gap-8 lg:flex-row">
                <!-- content - start -->
                <div class="xl:py-18 flex flex-col justify-center sm:text-center lg:py-12 lg:text-left xl:w-8/12">

                    <h1
                        class="font-family: ui-serif, Georgia, Cambria, mb-8 font-serif text-4xl font-bold text-white sm:text-5xl md:mb-12 md:text-6xl">
                        Don't miss our daily
                        amazing deal</h1>

                    <p class="mb-8 leading-relaxed text-white md:mb-12 lg:w-4/5 xl:text-lg">
                        save up 60% offer your first order</p>

                    <div class="flex flex-col gap-2.5 sm:flex-row sm:justify-center lg:justify-start">
                        <a href="#"
                            class="inline-block rounded-lg bg-lime-100 px-8 py-3 text-center text-sm font-semibold text-black outline-none ring-indigo-300 transition duration-100 hover:bg-lime-200 focus-visible:ring active:bg-indigo-700 md:text-base">Start
                            now</a>

                        <a href="#"
                            class="inline-block rounded-lg bg-gray-200 px-8 py-3 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-300 focus-visible:ring active:text-gray-700 md:text-base">Take
                            tour</a>
                    </div>
                </div>
                <!-- content - end -->

                <!-- image - start -->
                <div class="h-48 overflow-hidden lg:h-auto xl:w-7/12">
                    <img src="{{ asset('images/mainImg.png') }}" loading="lazy" alt="Photo by Fakurian Design"
                        class="h-full w-full object-center" />
                </div>
                <!-- image - end -->
            </section>
        </div>
    </div>
    {{-- categories product --}}
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-6 flex items-end justify-between gap-4">
                <h2
                    class="font-family: ui-sans-serif, system-ui, sans-serif, font-sans text-2xl font-bold text-gray-800 lg:text-3xl">
                    Kategori</h2>
            </div>

            <div class="grid gap-x-4 gap-y-8 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-4">
                <!-- product - start -->
                @foreach ($kategoriList as $kategori)
                    <x-card.kategori :id="$kategori->id" :gambar='$kategori->gambar' :nama='$kategori->nama' />
                @endforeach
                <!-- product - end -->
            </div>
        </div>
    </div>
    {{-- featured product --}}
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <!-- text - start -->
            <div class="mb-6 flex items-end justify-between gap-4">
                <h2
                    class="font-family: ui-sans-serif, system-ui, sans-serif, font-sans text-2xl font-bold text-gray-800 lg:text-3xl">
                    Featured Product</h2>

                <a href="{{ route('filter') }}"
                    class="inline-block rounded-lg border bg-white px-4 py-2 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:px-8 md:py-3 md:text-base">Show
                    more</a>
            </div>

            <!-- text - end -->

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                @foreach ($barangList as $barang)
                    <x-card.barang :id="$barang->id" :cover="$barang->cover" :nama="$barang->nama" :namaKategori="$barang->kategori->nama"
                        :harga="$barang->harga" :stok="$barang->stok" />
                @endforeach
            </div>
        </div>
    </div>
    {{-- callToAction --}}
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">

            <div class="grid gap-6 sm:grid-cols-2">
                <x-card.callToAction />
                <x-card.callToAction />
            </div>
        </div>
    </div>
    {{-- reviews --}}
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl xl:mb-12">Customer Reviews
            </h2>
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 md:gap-6">
                <x-card.review />
                <x-card.review />
                <x-card.review />
            </div>
        </div>
    </div>
    {{-- footer --}}
    <div class="bg-white pt-4 sm:pt-10 lg:pt-12">
        <footer class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-16 grid grid-cols-2 gap-12 border-t pt-10 md:grid-cols-4 lg:grid-cols-6 lg:gap-8 lg:pt-12">
                <div class="col-span-full lg:col-span-2">
                    <!-- logo - start -->
                    <div class="mb-4 lg:-mt-2">
                        <a href="/"
                            class="inline-flex items-center gap-2 text-xl font-bold text-black md:text-2xl"
                            aria-label="logo">
                            <svg width="95" height="94" viewBox="0 0 95 94" class="h-auto w-5 text-indigo-500"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M96 0V47L48 94H0V47L48 0H96Z" />
                            </svg>

                            Flowrift
                        </a>
                    </div>
                    <!-- logo - end -->

                    <p class="mb-6 text-gray-500 sm:pr-8">Filler text is dummy text which has no meaning however looks
                        very similar to real text.</p>

                    <!-- social - start -->
                    <div class="flex gap-4">
                        <a href="#" target="_blank"
                            class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                            <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>

                        <a href="#" target="_blank"
                            class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                            <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>

                        <a href="#" target="_blank"
                            class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                            <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>

                        <a href="#" target="_blank"
                            class="text-gray-400 transition duration-100 hover:text-gray-500 active:text-gray-600">
                            <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                    </div>
                    <!-- social - end -->
                </div>

                <!-- nav - start -->
                <div>
                    <div class="mb-4 font-bold uppercase tracking-widest text-gray-800">Products</div>

                    <nav class="flex flex-col gap-4">
                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Overview</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Solutions</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Pricing</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Customers</a>
                        </div>
                    </nav>
                </div>
                <!-- nav - end -->

                <!-- nav - start -->
                <div>
                    <div class="mb-4 font-bold uppercase tracking-widest text-gray-800">Company</div>

                    <nav class="flex flex-col gap-4">
                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">About</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Investor
                                Relations</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Jobs</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Press</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Blog</a>
                        </div>
                    </nav>
                </div>
                <!-- nav - end -->

                <!-- nav - start -->
                <div>
                    <div class="mb-4 font-bold uppercase tracking-widest text-gray-800">Support</div>

                    <nav class="flex flex-col gap-4">
                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Contact</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Documentation</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Chat</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">FAQ</a>
                        </div>
                    </nav>
                </div>
                <!-- nav - end -->

                <!-- nav - start -->
                <div>
                    <div class="mb-4 font-bold uppercase tracking-widest text-gray-800">Legal</div>

                    <nav class="flex flex-col gap-4">
                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Terms
                                of Service</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Privacy
                                Policy</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-gray-500 transition duration-100 hover:text-indigo-500 active:text-indigo-600">Cookie
                                settings</a>
                        </div>
                    </nav>
                </div>
                <!-- nav - end -->
            </div>
            <div class="border-t py-8 text-center text-sm text-gray-400">© 2021 - Present Palajawi. All rights
                reserved.</div>
        </footer>
    </div>
</div>
