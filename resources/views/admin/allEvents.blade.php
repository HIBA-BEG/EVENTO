<x-app-layout>

    <div class="min-h-screen flex flex-col sm:flex-row bg-gradient-to-r from-purple-300 to-blue-200">
        <!-- Content -->
        <div class="flex-grow p-4 bg-gradient-to-r from-purple-300 to-blue-200">
            <section class="flex flex-wrap mt-20 mx-auto md:px-12 flex-grow">
                <div class="container mx-auto px-4 md:px-12">
                    <div class="flex justify-center bg-white rounded-xl p-2 w-40 mb-5 shadow-lg">

                        <h2 class="text-lg font-bold">EVENTS</h2>
                    </div>
                    <div class="flex flex-wrap -mx-1 lg:-mx-4">
                        @foreach ($events as $event)
                            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                                <article class="overflow-hidden rounded-lg shadow-lg h-full bg-blue-100 ">
                                    <div class="flex flex-col justify-between py-6 px-8 h-52">
                                        <div class="flex justify-between">
                                            <div>
                                                <p class="text-black">
                                                    <span
                                                        class="italic text-md font-semibold underline text-blue-600/75">Category</span>
                                                    : {{ $event->category->title }}
                                                </p>
                                            </div>
                                            <div>
                                                @if ($event->status == 'Pending')
                                                <div class="flex gap-2">
                                                <form action="{{ route('updateStatus', $event->id) }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="status" value="Approved">
                                                    <button type="submit" class="rounded px-4 py-1 text-xs bg-green-500 text-green-100 hover:bg-green-600 duration-300">Accept</button>
                                                </form>
                                                
                                                <form action="{{ route('updateStatus', $event->id) }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="status" value="Rejected">
                                                    <button type="submit" class="rounded px-4 py-1 text-xs bg-red-600 text-red-100 hover:bg-red-700 duration-300">Reject</button>
                                                </form>
                                            </div>
                                                    
                                                @elseif($event->status == 'Approved')
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ $event->status }}</span>
                                                        @elseif($event->status == 'Rejected')
                                                        <span
                                                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">{{ $event->status }}</span>
                                                   
                                                        @endif
                                            </div>
                                        </div>

                                        <h1 class="flex justify-center items-center text-xl font-semibold ">
                                            {{ $event->title }}
                                        </h1>

                                        <div class="">
                                            <div class="flex justify-between text-sm text-gray-600">
                                                <div class="flex w-full flex-col gap-3">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="16" viewBox="0 0 384 512">
                                                            <path fill="#b31616"
                                                                d="M192 0C86 0 0 86 0 192c0 96 176 327 184 335.6a10.91 10.91 0 0 0 16 0C208 519 384 288 384 192 384 86 298 0 192 0zm0 304c-41.4 0-76.63-32.73-89.92-78.63a9 9 0 0 1 3.78-10.2l14.2-9.89a8.72 8.72 0 0 1 10.65 0l14.2 9.89a9 9 0 0 1 3.78 10.2C268.63 271.27 233.41 304 192 304zm16-176a16 16 0 1 0-16-16 16 16 0 0 0 16 16z" />
                                                            <circle cx="200" cy="200" r="95"
                                                                fill="rgb(219, 234, 254)" />
                                                        </svg>
                                                        <p class="ml-2 text-red-800"> {{ $event->location }}</p>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg viewBox="0 0 24 24" height="16" width="16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                                                    stroke="#000000" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <p class="ml-2"> {{ $event->user->name }}</p>
                                                    </div>

                                                </div>
                                                <div class="flex flex-col gap-3">

                                                    <div class="flex items-center">
                                                        <svg fill="#919191" height="16" width="16" version="1.1"
                                                            id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 283.629 283.629" xml:space="preserve"
                                                            stroke="#919191">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M84.871,41.11c-0.028,11.814-0.009,23.625-0.009,35.437c0,4.154-0.119,8.312,0.059,12.459 c0.142,3.405,2.59,5.617,5.747,5.626c3.197,0.009,5.512-2.184,5.804-5.563c0.084-1.031,0.028-2.075,0.028-3.115 c0-10.644-0.028-21.287,0.061-31.93c0.012-0.913,0.798-1.82,1.229-2.735c0.562,0.934,1.265,1.813,1.638,2.817 c0.254,0.684,0.054,1.538,0.054,2.317c0,31.542-0.004,63.085,0,94.623c0,5.562,2.59,8.807,7.005,8.896 c4.679,0.098,7.302-3.071,7.323-8.952c0.028-9.086,0.004-18.173,0.004-27.262c0-8.697-0.058-17.396,0.065-26.089 c0.017-1.057,0.999-2.103,1.536-3.155c0.453,0.187,0.912,0.369,1.367,0.556c0,1.533,0,3.073,0,4.606 c0,17.397,0.009,34.789-0.012,52.176c-0.004,3.258,0.966,6.338,4.14,7.196c2.322,0.626,5.75,0.486,7.46-0.858 c1.769-1.391,2.868-4.657,2.882-7.112c0.182-31.925,0.114-63.86,0.11-95.79c0-0.521-0.196-1.099-0.023-1.542 c0.325-0.843,0.845-1.601,1.286-2.395c0.493,0.73,1.274,1.41,1.41,2.203c0.238,1.386,0.091,2.845,0.091,4.268 c-0.005,9.864-0.044,19.728,0,29.596c0.019,4.697,2.093,7.192,5.777,7.236c3.79,0.042,5.792-2.348,5.797-7.078 c0.019-15.705,0.037-31.41-0.01-47.114c-0.023-7.78-4.522-12.213-12.393-12.253c-11.808-0.056-23.623-0.051-35.43-0.019 C89.349,28.182,84.89,32.641,84.871,41.11z">
                                                                        </path>
                                                                        <path
                                                                            d="M126.903,11.665c0.049-6.464-5.099-11.67-11.532-11.665c-6.445,0.004-11.708,5.229-11.666,11.59 c0.044,6.222,5.167,11.351,11.409,11.416C121.718,23.074,126.856,18.138,126.903,11.665z">
                                                                        </path>
                                                                        <path
                                                                            d="M244.34,51.319c0.49,0.73,1.274,1.41,1.41,2.203c0.237,1.386,0.088,2.845,0.088,4.268 c-0.004,9.864-0.046,19.728-0.004,29.596c0.019,4.697,2.095,7.192,5.777,7.236c3.79,0.042,5.792-2.348,5.797-7.078 c0.019-15.705,0.037-31.41-0.015-47.112c-0.022-7.782-4.522-12.216-12.391-12.256c-11.808-0.056-23.625-0.051-35.433-0.019 c-8.508,0.023-12.965,4.487-12.983,12.956c-0.028,11.814-0.01,23.625-0.01,35.437c0,4.154-0.121,8.312,0.056,12.458 c0.146,3.405,2.591,5.617,5.75,5.626c3.197,0.009,5.512-2.184,5.802-5.563c0.084-1.031,0.027-2.074,0.027-3.115 c0-10.643-0.027-21.287,0.065-31.93c0.01-0.913,0.799-1.82,1.228-2.735c0.565,0.934,1.265,1.813,1.639,2.816 c0.252,0.684,0.051,1.538,0.051,2.317c0,31.542-0.005,63.085,0,94.627c0,5.554,2.591,8.803,7.006,8.896 c4.681,0.094,7.304-3.075,7.322-8.961c0.028-9.082,0.005-18.168,0.005-27.258c0-8.697-0.057-17.396,0.065-26.089 c0.019-1.055,0.998-2.103,1.535-3.155c0.453,0.187,0.915,0.369,1.367,0.555c0,1.533,0,3.073,0,4.606 c0,17.396,0.01,34.789-0.009,52.181c-0.005,3.253,0.966,6.338,4.14,7.187c2.319,0.631,5.75,0.49,7.458-0.858 c1.769-1.391,2.87-4.653,2.884-7.104c0.183-31.93,0.112-63.864,0.107-95.794c0-0.521-0.196-1.099-0.023-1.542 C243.375,52.871,243.897,52.112,244.34,51.319z">
                                                                        </path>
                                                                        <path
                                                                            d="M238.619,11.665c0.047-6.464-5.101-11.67-11.532-11.665c-6.445,0.004-11.71,5.229-11.668,11.59 c0.047,6.222,5.167,11.351,11.411,11.416C233.434,23.074,238.572,18.138,238.619,11.665z">
                                                                        </path>
                                                                        <path
                                                                            d="M58.147,275.506c-0.004,3.254,0.964,6.338,4.137,7.192c2.324,0.626,5.75,0.49,7.46-0.863 c1.769-1.391,2.868-4.653,2.882-7.104c0.182-31.932,0.115-63.864,0.11-95.792c0-0.522-0.196-1.097-0.023-1.545 c0.324-0.84,0.845-1.601,1.286-2.394c0.492,0.732,1.276,1.409,1.409,2.203c0.238,1.386,0.091,2.842,0.091,4.271 c-0.004,9.861-0.049,19.723-0.004,29.594c0.019,4.699,2.093,7.191,5.778,7.238c3.79,0.037,5.792-2.353,5.796-7.085 c0.019-15.704,0.038-31.409-0.009-47.109c-0.023-7.784-4.52-12.218-12.391-12.256c-11.81-0.056-23.625-0.056-35.433-0.019 c-8.508,0.023-12.967,4.49-12.986,12.956c-0.028,11.812-0.01,23.625-0.01,35.433c0,4.153-0.119,8.316,0.059,12.461 c0.143,3.407,2.59,5.619,5.748,5.629c3.199,0.009,5.512-2.185,5.803-5.563c0.087-1.036,0.028-2.077,0.028-3.118 c0-10.641-0.028-21.286,0.063-31.932c0.009-0.91,0.798-1.82,1.228-2.73c0.564,0.929,1.267,1.811,1.638,2.814 c0.254,0.682,0.054,1.54,0.054,2.314c0,31.545-0.005,63.09,0,94.63c0,5.554,2.59,8.803,7.005,8.896 c4.679,0.094,7.304-3.075,7.323-8.961c0.028-9.082,0.005-18.164,0.005-27.256c0-8.699-0.059-17.398,0.067-26.089 c0.014-1.055,0.999-2.104,1.533-3.154c0.455,0.187,0.913,0.363,1.368,0.551c0,1.54,0,3.075,0,4.61 C58.157,240.718,58.166,258.108,58.147,275.506z">
                                                                        </path>
                                                                        <path
                                                                            d="M68.277,135.35c0.049-6.467-5.099-11.67-11.53-11.666c-6.448,0.004-11.71,5.227-11.668,11.588 c0.044,6.221,5.167,11.348,11.409,11.418C63.097,146.761,68.231,141.821,68.277,135.35z">
                                                                        </path>
                                                                        <path
                                                                            d="M137.961,164.794c-0.028,11.817-0.009,23.625-0.009,35.441c0,4.154-0.119,8.317,0.058,12.462 c0.143,3.397,2.591,5.609,5.748,5.619c3.199,0.009,5.512-2.185,5.803-5.563c0.087-1.026,0.028-2.072,0.028-3.113 c0.005-10.646-0.028-21.286,0.063-31.927c0.009-0.915,0.798-1.82,1.225-2.735c0.564,0.934,1.27,1.811,1.639,2.814 c0.257,0.686,0.056,1.535,0.056,2.319c0,31.54-0.005,63.08,0,94.625c0,5.559,2.591,8.802,7.005,8.891 c4.677,0.098,7.305-3.07,7.323-8.951c0.028-9.087,0.005-18.174,0.005-27.266c0-8.694-0.061-17.389,0.064-26.089 c0.015-1.055,0.999-2.1,1.536-3.15c0.452,0.183,0.91,0.369,1.367,0.556c0,1.531,0,3.071,0,4.602 c0,17.395,0.01,34.789-0.009,52.178c-0.005,3.258,0.961,6.338,4.135,7.197c2.324,0.625,5.75,0.485,7.463-0.859 c1.769-1.391,2.865-4.657,2.879-7.107c0.183-31.928,0.117-63.864,0.112-95.792c0-0.522-0.196-1.102-0.023-1.545 c0.322-0.84,0.845-1.601,1.283-2.394c0.495,0.728,1.279,1.409,1.41,2.202c0.237,1.387,0.093,2.848,0.093,4.267 c-0.004,9.865-0.051,19.731,0,29.598c0.019,4.695,2.091,7.197,5.778,7.234c3.789,0.047,5.792-2.343,5.796-7.08 c0.02-15.705,0.038-31.409-0.009-47.114c-0.023-7.775-4.522-12.214-12.396-12.251c-11.812-0.061-23.625-0.051-35.433-0.023 C142.444,151.867,137.987,156.329,137.961,164.794z">
                                                                        </path>
                                                                        <path
                                                                            d="M179.991,135.35c0.052-6.467-5.096-11.67-11.527-11.666c-6.45,0.004-11.71,5.227-11.668,11.588 c0.042,6.221,5.167,11.348,11.406,11.418C174.81,146.761,179.944,141.821,179.991,135.35z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="ml-2"> {{ $event->totalTickets }}</p>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg fill="#d0c00b" height="16" width="16"
                                                            viewBox="-2.4 -2.4 28.80 28.80"
                                                            xmlns="http://www.w3.org/2000/svg" stroke="#d0c00b"
                                                            stroke-width="0.00024000000000000003">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke="#CCCCCC"
                                                                stroke-width="0.048"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="m13.817 5.669 4.504 4.501-8.15 8.15-4.501-4.504zm-3.006 13.944 8.8-8.8c.166-.163.27-.389.27-.64s-.103-.477-.269-.64l-5.156-5.156c-.166-.158-.392-.255-.64-.255s-.474.097-.64.256l-8.8 8.8c-.166.163-.27.389-.27.64s.103.477.269.64l5.156 5.156c.166.158.392.255.64.255s.474-.097.64-.256zm12.663-9.073-12.918 12.933c-.332.326-.787.527-1.289.527s-.957-.201-1.289-.527l-1.794-1.793c.477-.492.77-1.164.77-1.905 0-1.513-1.227-2.74-2.74-2.74-.74 0-1.412.294-1.905.771l.001-.001-1.781-1.794c-.326-.332-.527-.787-.527-1.289s.201-.957.527-1.289l12.919-12.906c.332-.326.787-.527 1.289-.527s.957.201 1.289.527l1.781 1.781c-.515.499-.835 1.197-.835 1.969 0 1.513 1.227 2.74 2.74 2.74.773 0 1.471-.32 1.969-.835l.001-.001 1.794 1.781c.326.332.527.787.527 1.289s-.201.957-.527 1.289z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <p class="ml-2"> {{ $event->acceptance }}</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="flex justify-between items-center gap-9 mt-3">
                                                <div class="flex items-center text-green-500 gap-2">
                                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="ml-1 leading-none text-sm"> {{ $event->date }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach


                    </div>
                </div>
            </section>
            <div class="mt-8 flex justify-center">
                {{ $events->links('pagination::tailwind') }}
            </div>

        </div>
    </div>


</x-app-layout>
