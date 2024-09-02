@section('title', 'Edit Master Kuesioner')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Master Demografi') }}
        </h2>
    </x-slot>
    {{-- , forms: @json($existingAnswers) --}}

    <div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 space-y-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <form action="{{ route('master-kuesioner.update', $id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="relative bg-white border border-gray-200 rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Tambah Data Kuesioner
                                </h3>
                                <button @click="openModal = false" type="button"
                                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto "
                                    data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 space-y-4 md:p-5">
                                <div class="mb-5">
                                    <label for="isi_kuesioner" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Isi Kuesioner
                                    </label>
                                    <input type="text" id="isi_kuesioner" name="isi_kuesioner"
                                        value="{{ old('isi_kuesioner', $kuesioner->isi_kuesioner) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Isi Kuesioner ..." required />
                                    @error('isi_kuesioner')
                                        <div class="text-sm text-red-500 ">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="type_form" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Variable
                                    </label>
                                    <select id="type_form" name="variable" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select Variable</option>
                                        @foreach ($variable as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $kuesioner->variable_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->variable_nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('variable')
                                        <div class="text-sm text-red-500 ">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="isi_kuesioner" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Indikator
                                    </label>
                                    <input type="text" id="indikator" name="indikator"
                                        value="{{ old('isi_kuesioner', $kuesioner->indikator) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Indikator ..." required />
                                    @error('indikator')
                                        <div class="text-sm text-red-500 ">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="isi_kuesioner" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Kode Indikator
                                    </label>
                                    <input type="text" id="kode_indikator" name="kode_indikator"
                                        value="{{ old('isi_kuesioner', $kuesioner->kode_indikator) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Kode Indikator ..." required />
                                    @error('kode_indikator')
                                        <div class="text-sm text-red-500 ">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="is_positive" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Nilai Positif
                                    </label>
                                    <fieldset class="flex gap-4">
                                        <legend class="sr-only">Checkbox variants</legend>
                                        <div class="flex items-center mb-4">
                                            <input id="country-option-1" type="radio" name="is_positive"
                                                value="1"
                                                {{ old('is_positive', $kuesioner->is_positive) ? 'checked ="checked"' : '' }}
                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                                            <label for="country-option-1"
                                                class="block text-sm font-medium text-gray-900 ms-2 ">
                                                True
                                            </label>
                                        </div>


                                        <div class="flex items-center mb-4">
                                            <input id="country-option-2" type="radio" name="is_positive"
                                                value="0"
                                                {{ old('is_positive', $kuesioner->is_positive) ? '' : 'checked ="checked"' }}
                                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                            <label for="country-option-2"
                                                class="block text-sm font-medium text-gray-900 ms-2 ">
                                                False
                                            </label>
                                        </div>
                                    </fieldset>
                                    @error('is_positive')
                                        <div class="text-sm text-red-500 ">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b md:p-5 ">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
