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
}; ?>

<div>
    //
</div>
