@section('title', 'Master Demografi')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Master Demografi') }}
        </h2>
    </x-slot>
    <div x-data="{
        openModal: false,
        openModalDelete: false,
        typeForm: '',
        item_id: null,
    
        triggerModalDelete(id) {
            this.item_id = id;
            this.openModalDelete = true;
        },
        closeModalDelete() {
            this.openModalDelete = false;
        },
    }">

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 space-y-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    <div class="flex items-center justify-end">
                        <div class="flex items-center gap-4 p-4">
                            <button type="button" @click="openModal = true"
                                class="flex items-center w-full gap-2 px-4   py-1.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 sm:w-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Add Data
                            </button>
                        </div>
                    </div>
                    <div class="w-full">
                        @if (session('success'))
                            <div class="p-4 text-white bg-green-500 border-2 border-green-600 rounded-lg "
                                x-data="{ show: false }" x-init="() => {
                                    setTimeout(() => show = true, 300);
                                    setTimeout(() => show = false, 3000);
                                }" x-show="show"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="relative mb-5 overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-orange-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pertanyaan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jawaban
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tipe Form
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($demografi as $key => $item)
                                    <tr>
                                        <td class="px-6 py-3">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{ $item->question }}
                                        </td>
                                        <td class="px-6 py-3">
                                            <ul>
                                                @foreach (json_decode($item->answer) as $answer)
                                                    <li>{{ $answer }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{ $item->form_type }}
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="flex items-center gap-4">
                                                <a href="{{ route('master-demografi.edit', $item->id) }}"
                                                    class="px-2 py-1 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                                    Edit
                                                </a>
                                                <button @click="triggerModalDelete({{ $item->id }})"
                                                    class="px-2 py-1 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 ">
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div x-show="openModal" @keydown.escape.window="openModal = false" id="default-modal" tabindex="-1"
            aria-hidden="true" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
            x-cloak>
            <div class="relative w-full max-w-2xl max-h-full p-4">
                <!-- Modal content -->
                <form action="{{ route('master-demografi.post') }}" method="POST">
                    @csrf
                    <div class="relative bg-white border border-gray-200 rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Tambah Data Demografi
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
                                <label for="nama_pertanyaan" class="block mb-2 text-sm font-medium text-gray-900 ">
                                    Pertanyaan
                                </label>
                                <input type="text" id="pertanyaan" name="pertanyaan"
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

                            <div class="mb-5" x-data="{ forms: [{ id: 0 }] }" x-show="typeForm !== 'text'">
                                <label for="nama_pertanyaan" class="block mb-2 text-sm font-medium text-gray-900 ">
                                    Jawaban
                                </label>
                                <template x-for="(form, index) in forms" :key="index">
                                    <div class="flex items-center gap-4 mb-4 form-group">
                                        {{-- <label :for="'input-' + index" x-text="index"></label> --}}
                                        <input :id="'input-' + index" type="text" :name="'jawaban[' + index + ']'"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Masukan Jawaban...">
                                        <!-- Button to add a new form -->
                                        <button x-show="index > 0" @click="forms.splice(index, 1)" type="button"
                                            class="p-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600">
                                            X
                                        </button>
                                        <button x-show="index == 0" @click="forms.push({ id: index + 1 })"
                                            type="button"
                                            class="flex items-center justify-end p-2 text-sm text-white bg-blue-700 rounded-lg">
                                            +
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 ">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                Submit
                            </button>
                            <button @click="openModal = false" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                                Back
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div x-show="openModalDelete" @keydown.escape.window="openModalDelete = false" id="default-modal-delete"
            tabindex="-1" aria-hidden="true" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
            x-cloak>
            <div class="relative w-full max-w-2xl max-h-full p-4">
                <!-- Modal content -->
                <form action="{{ route('master-demografi.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="relative bg-white border border-gray-200 rounded-lg shadow">
                        <!-- Modal header -->
                        <input type="hidden" name="item_id" :value="item_id" />
                        <div class="flex items-center justify-between p-4 rounded-t md:p-5">
                            <div class="p-4 space-y-4 md:p-5">
                                Apakah Anda yakin ingin menghapus data ini?
                            </div>

                            <button @click="openModalDelete = false" type="button"
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
                        <!-- Modal footer -->
                        <div class="flex items-center justify-end p-4 border-gray-200 rounded-b md:p-5 ">
                            <button type="submit"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                Delete
                            </button>
                            <button @click="openModalDelete = false" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                                Back
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>
