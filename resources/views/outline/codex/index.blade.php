@extends('layouts.app')

@section('content')
    <h1 class="page-title">Codex</h1>

    @fragment('codex-entry-list')
        <div class="codex-list content" id="codex-list" x-data="{ filter: 'none' }">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl ml-2 font-bold">Codex Entries</h2>
                <a href="{{ route('outline.codex.create') }}" class="btn inline-block"
                    @if ($isHtmx) hx-get="{{ route('outline.codex.create') }}"
                    hx-target="#modal" hx-swap="innerHTML" @endif>
                    Add a New Codex Entry
                </a>
            </div>

            @if ($isHtmx)
                <div class="filters mb-4">
                    <p>Filters:</p>
                    <button class="btn btn-tertiary" x-on:click="filter != 'all'? filter = 'all' : filter = 'none'"
                        :class="{ 'active': filter === 'all' }">
                        All</button>
                    <button class="btn btn-tertiary" x-on:click="filter != 'character'? filter = 'character' : filter = 'none'"
                        :class="{ 'active': filter === 'character' }">
                        Characters</button>
                    <button class="btn btn-tertiary" x-on:click="filter != 'item'? filter = 'item' : filter = 'none'"
                        :class="{ 'active': filter === 'item' }">
                        Items</button>
                    <button class="btn btn-tertiary" x-on:click="filter != 'location'? filter = 'location' : filter = 'none'"
                        :class="{ 'active': filter === 'location' }">
                        Locations</button>
                </div>
            @endif

            @php
                $types = ['character', 'item', 'location'];
            @endphp

            @foreach ($types as $type)
                @if (isset($codexEntries[$type]) && $codexEntries[$type]->count())
                    <div class="codex-group codex-group-{{ $type }} mb-6" x-show="">
                        <h2>{{ ucfirst($type) }}s</h2>
                        <ul>
                            @foreach ($codexEntries[$type] as $entry)
                                <li class="codex-entry" id="codex-entry-{{ $entry->id }}">
                                    <a href="{{ route('outline.codex.show', $entry) }}"
                                        @if ($isHtmx) hx-get="{{ route('outline.codex.show', $entry) }}"
                                        hx-target="#modal"
                                        hx-swap="innerHTML" @endif>
                                        {{ $entry->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach

            @if ($codexEntries->isEmpty())
                <p class="empty">No codex entries yet. Add your first character, item, or location!</p>
            @endif

        </div>
    @endfragment
@endsection
