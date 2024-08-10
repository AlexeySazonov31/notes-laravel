<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;
    public $heartcount;

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->heartcount = $note->heart_count;
    }

    public function increaseHeartCount()
    {
        $this->note->heart_count++;
        $this->note->save();
        $this->heartcount = $this->note->heart_count;
    }
}; ?>

<div>
    <x-button xs wire:click='increaseHeartCount' rose icon="heart" spinner>{{ $heartcount }}</x-button>
</div>
