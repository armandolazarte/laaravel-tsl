<div>

    <div class="flex flex-wrap items-center justify-between mb-4">
        <div class="flex-grow mr-3 mb-3 md:mb-0">
            <input class="w-full px-3 h-12 border-2 rounded-lg" type="search" placeholder="Search files and folders">
        </div>
        <div>
            <div>
                <button class="bg-gray-200 px-6 h-12 rounded-lg mr-2" wire:click="$set('creatingNewFolder', true)">
                    New Folder
                </button>
                <button wire:click="$set('showingFileUploadModal', true)" class="bg-blue-600 text-white px-6 h-12 rounded-lg mr-2">
                    Upload Files
                </button>
            </div>
        </div>
    </div>

    <div class="border-2 border-gray-200 rounded-lg">
        <div class="py-2 px-3">
            <div class="flex items-center">
                @foreach ($ancestors as $ancestor)
                <a class="text-gray-400 font-bold" href="{{ route('files', ['uuid' => $ancestor->uuid]) }}">
                    {{ $ancestor->objectable->name }}
                </a>

                @if(!$loop->last)
                <svg class="text-gray-300 w-5 h-5 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                @endif
                @endforeach
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
                @if ($creatingNewFolder)
                <tr class="border-gray-100 border-b-2 hover:bg-gray-100">
                    <td class="p-3">
                        <form class="flex items-center" wire:submit.prevent="createFolder">
                            <input wire:model="newFolderState.name" type="text" name="" id="" class="w-full px-3 h-10 border-2 border-gray-200 rounded-lg mr-2 ">
                            <button class="bg-blue-600 text-white px-6 h-12 rounded-lg mr-2" type="submit">Create
                            </button>
                            <button class="bg-gray-200 px-6 h-12 rounded-lg mr-2" wire:click="$set('creatingNewFolder', false)">Cancel
                            </button>
                        </form>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endif
                @foreach ($object->children as $child)
                <tr>
                    <td class="text-left py-2 px-3 flex items-center">

                        @if ($child->objectable_type === 'file')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        @endif
                        @if ($child->objectable_type === 'folder')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        @endif

                        @if ($renamingObject === $child->id)
                        <form wire:submit.prevent="renameObject" class="flex items-center ml-2 flex-grow">
                            <input wire:model="renamingObjectState.name" type="text" name="" id="" class="w-full px-3 h-10 border-2 border-gray-200 rounded-lg mr-2 ">
                            <button class="bg-blue-600 text-white px-6 h-12 rounded-lg mr-2" type="submit">
                                Rename
                            </button>
                            <button wire:click="$set('renamingObject', null)" class="bg-gray-200 px-6 h-12 rounded-lg mr-2">Cancel
                            </button>
                        </form>
                        @else

                        @if ($child->objectable_type === 'folder')
                        <a href="{{ route('files', ['uuid' => $child->uuid]) }}" class="p-2 font-bold text-blue-700 flex-grow">
                            {{ $child->objectable->name }}
                        </a>
                        @endif
                        @if ($child->objectable_type === 'file')
                        <a href="" class="p-2 font-bold text-blue-700 flex-grow">
                            {{ $child->objectable->name }}
                        </a>
                        @endif

                        @endif
                    </td>

                    <td class="text-left py-2 px-3">
                        @if ($child->objectable_type === 'file')
                        {{$child->objectable->size }}
                        @else
                        --
                        @endif
                    </td>

                    <td class="text-left py-2 px-3">
                        {{ $child->created_at }}
                    </td>
                    <td class="text-left py-2 px-3">
                        <div class="flex justify-end items-center">
                            <ul class="flex items-center">
                                <li class="mr-4">
                                    <button wire:click="$set('renamingObject', {{$child->id}})" class="text-gray-400 font-bold">Rename</button>
                                </li>
                                <li>
                                    <button class="text-red-400 font-bold">Delete</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    @if ($object->children->count() === 0)
    <div class="py-3 text-gray-700">
        This folder is empty
    </div>
    @endif

    <x-jet-modal wire:model="showingFileUploadModal">
    <div
        wire:ignore
        class="m-3 border-dashed border-2"
        x-data="{
            initFilepond() {
                const pond = FilePond.create(this.$refs.filepond, {
                    
                    server: {
                        process: (fieldName, file, metadata, load, error,
                        progress, abort, transfer, options) => {
                            @this.upload('upload', file, load, error, progress)
                        }
                    }
                });
            }

        }"
        x-init="initFilepond"
    >
        <div>
            <input type="file" x-ref="filepond" multiple>
        </div>
    </div>
    </x-jet-modal>
</div>