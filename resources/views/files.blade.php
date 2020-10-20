<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div>
                    <div class="flex flex-wrap items-center justify-between mb-4">
                        <div class="flex-grow mr-3 mb-3 md:mb-0">
                            <input class="w-full px-3 h-12 border-2 rounded-lg" type="search" placeholder="Search files and folders">
                        </div>
                        <div>
                            <div>
                                <button class="bg-gray-200 px-6 h-12 rounded-lg mr-2">
                                    New Folder
                                </button>
                                <button class="bg-blue-600 text-white px-6 h-12 rounded-lg mr-2">
                                    Upload Files
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="border-2 border-gray-200 rounded-lg">
                        <div class="py-2 px-3">
                            <div class="flex items-center">
                                <a class="text-gray-400 font-bold" href="">Breadcrumb</a>
                                <svg class="text-gray-300 w-5 h-5 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>

                        <table class="w-full table-fixed">
                            <thead class="bg-gray-100">
                                <tr class="border-gray-100 border-b-2 hover:bg-gray-100">
                                    <th class="text-left py-2 px-3">Name
                                    </th>
                                    <th class="text-left py-2 px-3 w-2/12">Size</th>
                                    <th class="text-left py-2 px-3 w-2/12">Created</th>
                                    <th class="p-2 w-2/12"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left py-2 px-3 flex items-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                        </svg>
                                        <a href="" class="p-2 font-bold text-blue-700 flex-grow">File/Folder name</a>
                                    </td>
                                    <td class="text-left py-2 px-3">Size</td>
                                    <td class="text-left py-2 px-3">Date</td>
                                    <td class="text-left py-2 px-3">
                                        <div class="flex justify-end items-center">
                                            <ul class="flex items-center">
                                                <li class="mr-4">
                                                    <button class="text-gray-400 font-bold">Rename</button>
                                                </li>
                                                <li>
                                                    <button class="text-red-400 font-bold">Delete</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left py-2 px-3">Name</td>
                                    <td class="text-left py-2 px-3">Size</td>
                                    <td class="text-left py-2 px-3">Date</td>
                                    <td class="text-left py-2 px-3">
                                        <div class="flex justify-end items-center">
                                            <ul class="flex items-center">
                                                <li class="mr-4">
                                                    <button class="text-gray-400 font-bold">Rename</button>
                                                </li>
                                                <li>
                                                    <button class="text-red-400 font-bold">Delete</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>