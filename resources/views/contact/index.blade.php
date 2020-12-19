<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact List') }}
        </h2>
    </x-slot>

    <section class="py-10 bg-gray-100  bg-opacity-50">
        <form method="POST" action="{{ route('contacts.create') }}">
            @csrf

            <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md">
                <div class="md:inline-flex  space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
                    <h2 class="md:w-1/3 mx-auto max-w-sm">New contact</h2>
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
                                        name="phone"
                                        type="text"
                                        class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                                />
                            </div>
                        </div>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors"/>


                        <div class="text-center md:pl-6">
                            <button class="text-white w-full mx-auto max-w-sm rounded-md text-center bg-indigo-400 py-2 px-4 inline-flex items-center focus:outline-none md:float-right">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <section class="py-10 bg-gray-100  bg-opacity-50">
        <form method="POST" action="{{ route('contacts.delete') }}">
            @csrf

            <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md">
                <!-- component -->
                <div>
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                        <tr class="bg-gray-800">
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Name</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Phone</span>
                            </th>

                            <th class="px-16 py-2">
                                <span class="text-gray-300">Favorite</span>
                            </th>

                            <th class="px-16 py-2">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                        @foreach ($contacts as $contact)
                            <tr class="bg-white border-4 border-gray-200">
                                <td>
                                    <a href="{{ route('contacts.show', ['id' => $contact->id]) }}">
                                        <span class="text-center ml-2 font-semibold">{{ $contact->name }}</span>
                                    </a>
                                </td>
                                <td class="px-16 py-2">
                                    <a href="{{ route('contacts.show', ['id' => $contact->id]) }}">
                                        <span>{{ $contact->phone }}</span>
                                    </a>
                                </td>

                                <td class="px-16 py-2">
                  <span class="text-green-500">
                      @if ($contact->favorite == 1)
                          <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="w-5 h5 "
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="#2c3e50"
                                  fill="none"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                          >
                      <path stroke="none" d="M0 0h24v24H0z"/>
                      <path d="M5 12l5 5l10 -10"/>
                    </svg>
                      @else
                          <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="w-5 h-5"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="#2c3e50"
                                  fill="none"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                          >
                  <path stroke="none" d="M0 0h24v24H0z"/>
                  <line x1="18" y1="6" x2="6" y2="18"/>
                  <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
                      @endif


                  </span>
                                </td>
                                <td class="px-16 py-2">
                                    <button name="contact{{ $contact->id }}"
                                            class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
        </form>
    </section>
</x-app-layout>
