@section('title', 'Dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 space-y-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @if (!count($user) > 0)
                    @if ($errors->any())
                        <div class="p-4 bg-red-200 border-red-500">
                            <ul>
                                <p class="font-semibold">Error:</p>
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="w-full md:w-1/2" action="{{ route('demografi.post') }}" method="post">
                        @csrf
                        <div class="px-4 py-2 mb-6 border-2 border-orange-400 rounded-lg">
                            <p class="text-2xl font-semibold text-gray-900">
                                Data Responden
                            </p>
                        </div>

                        <div class="mb-5">
                            <label for="nama_mahasiswa" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Nama Mahasiswa
                            </label>
                            <input type="text" id="nama_mahasiswa" name="nama_mahasiswa"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Nama Mahasiswa ..." required />
                        </div>
                        <div class="mb-5">
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 ">NIM</label>
                            <input type="text" id="nim" name="nim"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="NIM ..." required />
                        </div>
                        <div class="mb-5">
                            <label for="prodi" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Program Studi
                            </label>
                            <select id="prodi" name="prodi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Program Studi</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                            </select>
                            @error('prodi')
                                <div class="text-sm text-red-500 ">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-5">
                            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Jenis Kelamin
                            </label>
                            <fieldset class="flex gap-4">
                                <legend class="sr-only">Checkbox variants</legend>
                                <div class="flex items-center mb-4">
                                    <input id="country-option-1" type="radio" name="jenis_kelamin" value="Laki-Laki"
                                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                                    <label for="country-option-1" class="block text-sm font-medium text-gray-900 ms-2 ">
                                        Laki-Laki
                                    </label>
                                </div>


                                <div class="flex items-center mb-4">
                                    <input id="country-option-2" type="radio" name="jenis_kelamin" value="Perempuan"
                                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                    <label for="country-option-2" cla
                                        ss="block text-sm font-medium text-gray-900 ms-2 ">
                                        Perempuan
                                    </label>
                                </div>
                            </fieldset>
                            @error('jenis_kelamin')
                                <div class="text-sm text-red-500 ">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="px-4 py-2 mb-6 border-2 border-orange-400 rounded-lg">
                            <p class="text-2xl font-semibold text-gray-900">
                                Data Demografi
                            </p>
                        </div>

                        @foreach ($demografi as $key => $item)
                            {{-- @dump($item) --}}
                            @if ($item->form_type == 'text')
                                <div class="mb-5">
                                    <label for="nama_mahasiswa" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        {{ $item->question }}
                                    </label>
                                    <input type="text" id="nama_mahasiswa"
                                        name="{{ 'demografi_answers[' . $item->id . '][' . $item->slug_question . ']' }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="{{ $item->question }} ..." required />
                                </div>
                            @else
                                <div class="mb-5">
                                    <input type="hidden" name="demografi_id[{{ $item->id }}]"
                                        value="{{ $item->id }}">
                                    <label for="{{ $item->question }}"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">
                                        {{ $item->question }}
                                    </label>
                                    <fieldset class="flex flex-wrap gap-4">
                                        <legend class="sr-only">Checkbox variants</legend>
                                        @foreach (json_decode($item->answer) as $answer)
                                            <div class="flex items-center mb-4">
                                                <input id="{{ $item->id }}" type="{{ $item->form_type }}"
                                                    name="{{ 'demografi_answers[' . $item->id . '][' . $item->slug_question . ']' }}"
                                                    value="{{ $answer }}"
                                                    class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                                                <label for="{{ $item->id }}"
                                                    class="block text-sm font-medium text-gray-900 ms-2 ">
                                                    {{ $answer }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </fieldset>
                                </div>
                            @endif
                        @endforeach


                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                @else
                    <p class="text-xl font-semibold leading-tight text-gray-800">Anda Sudah Mengisi Data Demografi dan
                        Responden</p>
                @endif


            </div>
        </div>
    </div>
</x-app-layout>
