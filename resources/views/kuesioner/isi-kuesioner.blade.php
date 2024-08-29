<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Isi Kuesioner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (!count($kuesioner) > 0)

                        <form action="{{ route('kuesioner.post') }}" method="post">
                            @csrf

                            @foreach ($forms as $form)
                                <div id="accordion-collapse" x-data="{ open: true }">
                                    <button type="button" @click="open = !open"
                                        class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-gray-200 rtl:text-right focus:ring-4 focus:ring-gray-200 ">
                                        <span>{{ $form->variable_nama }}</span>
                                        <svg x-bind:class="{ 'rotate-180': open }"
                                            class="w-3 h-3 transition-transform duration-200" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                    <div x-show="open">
                                        <div class="p-5 border border-gray-200 ">
                                            @foreach ($form->pernyataan as $pernyataan)
                                                <div class="mb-5">
                                                    <input type="hidden" name="kuesioner[{{ $pernyataan->id }}]"
                                                        value="{{ $pernyataan->id }}">
                                                    <label for="{{ $pernyataan->isi_kuesioner }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 ">
                                                        {{ $pernyataan->isi_kuesioner }}
                                                    </label>
                                                    <fieldset class="flex flex-wrap gap-4">
                                                        <legend class="sr-only">Checkbox variants</legend>
                                                        <div class="flex items-center mb-4">
                                                            <input id="{{ $pernyataan->id }}" type="radio"
                                                                name="{{ 'kuesioner_answers[' . $pernyataan->id . ']' }}"
                                                                value="{{ $pernyataan->is_positive == 1 ? 1 : 5 }}"
                                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                                            <label for="{{ $pernyataan->id }}"
                                                                class="block text-sm font-medium text-gray-900 ms-2 ">
                                                                Sangat Tidak Setuju
                                                            </label>
                                                        </div>
                                                        <div class="flex items-center mb-4">
                                                            <input id="{{ $pernyataan->id }}" type="radio"
                                                                name="{{ 'kuesioner_answers[' . $pernyataan->id . ']' }}"
                                                                value="{{ $pernyataan->is_positive == 1 ? 2 : 4 }}"
                                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                                            <label for="{{ $pernyataan->id }}"
                                                                class="block text-sm font-medium text-gray-900 ms-2 ">
                                                                Tidak Setuju
                                                            </label>
                                                        </div>
                                                        <div class="flex items-center mb-4">
                                                            <input id="{{ $pernyataan->id }}" type="radio"
                                                                name="{{ 'kuesioner_answers[' . $pernyataan->id . ']' }}"
                                                                value="3"
                                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                                            <label for="{{ $pernyataan->id }}"
                                                                class="block text-sm font-medium text-gray-900 ms-2 ">
                                                                Netral
                                                            </label>
                                                        </div>
                                                        <div class="flex items-center mb-4">
                                                            <input id="{{ $pernyataan->id }}" type="radio"
                                                                name="{{ 'kuesioner_answers[' . $pernyataan->id . ']' }}"
                                                                value="{{ $pernyataan->is_positive == 1 ? 4 : 2 }}"
                                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                                            <label for="{{ $pernyataan->id }}"
                                                                class="block text-sm font-medium text-gray-900 ms-2 ">
                                                                Setuju
                                                            </label>
                                                        </div>
                                                        <div class="flex items-center mb-4">
                                                            <input id="{{ $pernyataan->id }}" type="radio"
                                                                name="{{ 'kuesioner_answers[' . $pernyataan->id . ']' }}"
                                                                value="{{ $pernyataan->is_positive == 1 ? 5 : 1 }}"
                                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                                            <label for="{{ $pernyataan->id }}"
                                                                class="block text-sm font-medium text-gray-900 ms-2 ">
                                                                Sangat Setuju
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit"
                                class="text-white mt-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>

                        </form>
                    @else
                        <p class="text-xl font-semibold leading-tight text-gray-800">Anda Sudah Mengisi Kuesioner</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
