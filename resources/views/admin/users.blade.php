<x-app-layout>
    <div class="min-h-screen flex flex-col sm:flex-row bg-gray-100">
        <!-- Content -->
        <div class="flex-grow p-4 bg-gray-200">
            <div class="px-6 py-8 max-w-4xl mx-auto">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-yellow-100 border-2 border-yellow-700 rounded-3xl p-8 mb-5">
                        <h1 class="text-3xl font-bold mb-10">Users</h1>
                        <div class="text-xl font-semibold text-red-500">
                        </div>
                        <hr class="my-10 border border-yellow-700">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <!-- card user -->
                            @foreach ($users as $user)
                                @if ($user->banned)
                                    <div
                                        class="flex flex-col justify-around bg-white opacity-70 overflow-hidden shadow sm:rounded-lg h-[100px] p-4">
                                        <div class="flex gap-2">
                                            @if ($user->role == 'Organizer')
                                                <div
                                                    class="rounded-full bg-yellow-400 h-8 w-8 flex items-center justify-center">
                                                    <span class="text-xl text-black">&#x2600;</span>
                                                </div>
                                            @elseif($user->role == 'Client')
                                                <div
                                                    class="rounded-full bg-blue-500 h-8 w-8 flex items-center justify-center">
                                                    <span class="text-xl text-black">&#x1F4E6;</span>
                                                </div>
                                            @endif
                                            <span
                                                class=" flex text-md text-gray-400 whitespace-nowrap">{{ $user->role }}</span>
                                        </div>
                                        <div class="flex items-center ">
                                            <span
                                                class="mt-2 text-xl font-semibold text-black whitespace-nowrap">{{ $user->name }}</span>
                                        </div>
                                        <div class="flex justify-end h-fit">
                                            <form action="{{ route('unban.user', ['userId' => $user->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div title="unban">
                                                    <button type="submit">
                                                        <svg height="16" width="14" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            stroke="#1dd33b">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M4.52185 7H7C7.55229 7 8 7.44772 8 8C8 8.55229 7.55228 9 7 9H3C1.89543 9 1 8.10457 1 7V3C1 2.44772 1.44772 2 2 2C2.55228 2 3 2.44772 3 3V5.6754C4.26953 3.8688 6.06062 2.47676 8.14852 1.69631C10.6633 0.756291 13.435 0.768419 15.9415 1.73041C18.448 2.69239 20.5161 4.53782 21.7562 6.91897C22.9963 9.30013 23.3228 12.0526 22.6741 14.6578C22.0254 17.263 20.4464 19.541 18.2345 21.0626C16.0226 22.5842 13.3306 23.2444 10.6657 22.9188C8.00083 22.5931 5.54702 21.3041 3.76664 19.2946C2.20818 17.5356 1.25993 15.3309 1.04625 13.0078C0.995657 12.4579 1.45216 12.0088 2.00445 12.0084C2.55673 12.0079 3.00351 12.4566 3.06526 13.0055C3.27138 14.8374 4.03712 16.5706 5.27027 17.9625C6.7255 19.605 8.73118 20.6586 10.9094 20.9247C13.0876 21.1909 15.288 20.6513 17.0959 19.4075C18.9039 18.1638 20.1945 16.3018 20.7247 14.1724C21.2549 12.043 20.9881 9.79319 19.9745 7.8469C18.9608 5.90061 17.2704 4.3922 15.2217 3.6059C13.173 2.8196 10.9074 2.80968 8.8519 3.57803C7.11008 4.22911 5.62099 5.40094 4.57993 6.92229C4.56156 6.94914 4.54217 6.97505 4.52185 7Z"
                                                                    fill="#0F0F0F"></path>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="flex flex-col justify-around bg-white overflow-hidden shadow sm:rounded-lg h-[100px] p-4">
                                        <div class="flex gap-2">
                                            @if ($user->role == 'Organizer')
                                                <div
                                                    class="rounded-full bg-yellow-400 h-8 w-8 flex items-center justify-center">
                                                    <span class="text-xl text-black">&#x2600;</span>
                                                </div>
                                            @elseif($user->role == 'Client')
                                                <div
                                                    class="rounded-full bg-blue-500 h-8 w-8 flex items-center justify-center">
                                                    <span class="text-xl text-black">&#x1F4E6;</span>
                                                </div>
                                            @endif
                                            <span
                                                class=" flex text-md text-gray-400 whitespace-nowrap">{{ $user->role }}</span>
                                        </div>
                                        <div class="flex items-center ">
                                            <span
                                                class="mt-2 text-xl font-semibold text-black whitespace-nowrap">{{ $user->name }}</span>
                                        </div>
                                        <div class="flex justify-end h-fit">
                                            <form action="{{ route('ban.user', ['userId' => $user->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div title="ban">
                                                    <button type="submit">
                                                        <svg height="16" width="14" fill="#fb0909"
                                                            viewBox="0 0 32 32" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg" transform="rotate(90)">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M16 0c-8.836 0-16 7.163-16 16s7.163 16 16 16c8.837 0 16-7.163 16-16s-7.163-16-16-16zM2 16c0-3.508 1.3-6.717 3.441-9.177l19.745 19.745c-2.46 2.152-5.673 3.463-9.186 3.463-7.72 0-14-6.312-14-14.032v0zM26.594 25.15l-19.738-19.738c2.456-2.123 5.651-3.412 9.143-3.412 7.72 0 14 6.28 14 14 0 3.489-1.286 6.689-3.406 9.149z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
