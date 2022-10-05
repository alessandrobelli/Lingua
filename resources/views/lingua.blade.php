@extends('lingua::layouts.app')

@section('content')

<div class="flex flex-row space-x-4">

    @if(in_array(auth()->user()->email, config('lingua.admin')))
    <livewire:scan-for-strings>
        <livewire:manage-locales>
            <livewire:confirm-delete-modal>
                @endif

</div>
<livewire:translation-table>
    @endsection