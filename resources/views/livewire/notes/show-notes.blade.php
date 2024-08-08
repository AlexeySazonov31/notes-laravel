<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <ul>
        @foreach ($notes as $note)
            <li>{{ $note->title }}</li>
        @endforeach
    </ul>
</div>
