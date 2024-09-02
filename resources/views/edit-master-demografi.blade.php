@section('title', 'Edit Master Demografi')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Master Demografi') }}
        </h2>
    </x-slot>
    {{-- , forms: @json($existingAnswers) --}}

    <div x-data="{ typeForm: '{{ old('type_form', $demografi->form_type) }}' }">

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 space-y-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <form action="{{ route('master-demografi.update', $id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-5">
                            <label for="nama_pertanyaan" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Pertanyaan
                            </label>
                            <input type="text" id="pertanyaan" name="pertanyaan"
                                value="{{ old('question', $demografi->question) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Pertanyaan ..." required />
                            @error('pertanyaan')
                                <div class="text-sm text-red-500 ">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="type_form" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Tipe Form
                            </label>
                            <select id="type_form" name="type_form" x-model="typeForm" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select Type Form</option>
                                <option value="radio">Radio Form</option>
                                <option value="text">Text Form</option>
                                <option value="select">Select Option Form</option>
                                <option value="checkbox">Checkbox Form</option>
                            </select>
                            @error('type_form')
                                <div class="text-sm text-red-500 ">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- x-data="{ forms: '{{ json_decode($demografi->answer, true) }}' } --}}
                        <div class="mb-5" x-show="typeForm !== 'text'" x-data="{ forms: [], init() { this.forms = JSON.parse('{{ $demografi->answer }}'); } }"
                            x-init="init()">
                            <label for="nama_pertanyaan" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Jawaban
                            </label>
                            <template x-for="(form, index) in forms" :key="index">
                                <div class="flex items-center gap-4 mb-4 form-group">
                                    <input :id="'input-' + index" type="text" :name="'jawaban[' + index + ']'"
                                        :value="form"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Jawaban...">
                                    <!-- Button to add a new form -->
                                    <button x-show="index > 0" @click="forms.splice(index, 1)" type="button"
                                        class="p-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600">
                                        X
                                    </button>
                                    <button x-show="index == 0" @click="forms.push({ id: index })" type="button"
                                        class="flex items-center justify-end p-2 text-sm text-white bg-blue-700 rounded-lg">
                                        +
                                    </button>
                                </div>
                            </template>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                            Update
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
