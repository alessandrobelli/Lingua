@extends('lingua::layouts.app')

@section('content')

        @if(in_array(auth()->user()->email, config('lingua.admin')))
            <livewire:scan-for-strings>

            <livewire:manage-locales>
                <livewire:confirm-delete-modal>

                @endif
    <livewire:translation-table>

@endsection
