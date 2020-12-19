<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Contact: {{ $contact->name  }}
        </h2>
    </x-slot>

    <section class="py-10 bg-gray-100  bg-opacity-50">
        <form method="POST" action="{{ route('contacts.update', ['id' => $contact->id]) }}">
            @csrf

            <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md">
                <div class="md:inline-flex  space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
                    <h2 class="md:w-1/3 mx-auto max-w-sm">Contact info</h2>
                    <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
                        <div>
                            <label class="text-sm text-gray-400">Full name</label>
                            <div class="w-full inline-flex border">
                                <div class="w-1/12 pt-2 bg-gray-100">
                                    <svg
                                            fill="none"
                                            class="w-6 text-gray-400 mx-auto"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        />
                                    </svg>
                                </div>
                                <input
                                        required
                                        value="{{$contact->name}}"
                                        autofocus
                                        name="name"
                                        type="text"
                                        class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                                />
                            </div>
                        </div>
                        <div>
                            <label class="text-sm text-gray-400">Phone number</label>
                            <div class="w-full inline-flex border">
                                <div class="pt-2 w-1/12 bg-gray-100">
                                    <svg
                                            fill="none"
                                            class="w-6 text-gray-400 mx-auto"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"
                                        />
                                    </svg>
                                </div>
                                <input
                                        required
                                        value="{{$contact->phone}}"
                                        name="phone"
                                        type="text"
                                        class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-gray-400">Favorite</label>
                            <input
                                    @if($contact->favorite)
                                        checked="checked"
                                    @endif
                                    name="favorite"
                                    type="checkbox"
                            />
                        </div>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors"/>


                        <div class="text-center md:pl-6">
                            <button class="text-white w-full mx-auto max-w-sm rounded-md text-center bg-indigo-400 py-2 px-4 inline-flex items-center focus:outline-none md:float-right">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

</x-app-layout>
