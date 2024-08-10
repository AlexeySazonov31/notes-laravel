<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">No notes yet</p>
                <p class="text-sm">Let's create your first note to send</p>
                <x-button class="mt-6" primary icon-right="plus" href="{{ route('notes.create') }}" wire:navigate>
                    Create note
                </x-button>
            </div>
        @else
            <x-button class="mb-12" primary icon-right="plus" href="{{ route('notes.create') }}" wire:navigate>
                Create note
            </x-button>
            <div class="grid grid-cols-1 gap-4 mt-12 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($notes as $note)
                    <div class="flex flex-col h-full p-4 bg-white rounded-lg shadow">
                        <div class="flex-grow">
                            <div class="flex justify-between">
                                <div>
                                    <a href="{{ route('notes.edit', $note) }}" wire:navigate
                                        class="text-xl font-bold hover:underline hover:text-blue-500 line-clamp-2">
                                        {{ $note->title }}
                                    </a>
                                    <p class="mt-2 text-xs">{{ Str::limit($note->body, 60) }}</p>
                                </div>
                                <div class="text-xs text-right text-gray-500 min-w-20">
                                    {{ \Carbon\Carbon::parse($note->send_date)->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center justify-between">
                                <p class="text-xs">
                                    Recipient:
                                    <span class="font-semibold">
                                        {{ $note->recipient }}
                                    </span>
                                </p>
                                <div class="flex ml-3 space-x-1">
                                    <x-mini-button class="border" rounded icon="eye" flat gray
                                        interaction="primary" />
                                    <x-mini-button class="border" rounded icon="trash" flat gray
                                        interaction="negative" wire:click="delete('{{ $note->id }}')" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
