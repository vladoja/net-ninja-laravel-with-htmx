@extends('layouts.app')

@section('content')
    <div class="outline-wrapper">

        <div class="dashboard">
            <div class="col-span-3" hx-get="{{ route('outline.chapters.index') }}" hx-trigger="load" hx-swap="innerHTML">
            </div>
            <div class="col-span-2" hx-get="{{ route('outline.codex.index') }}" hx-trigger="load" hx-swap="innerHTML"></div>


        </div>

        <div class="modal-container"
            hx-on:click="        const modal = document.getElementById('modal');
        if (!modal.contains(event.target)) modal.innerHTML = '';">
            >
            <div class="modal-content" id="modal"></div>
        </div>

        <noscript>
            <h1 class="page-title">Outline Home</h1>

            <div class="content">
                <h2 class="text-bold text-center text-4xl my-12">Start Outlining Your Novel!</h2>
                <p class="text-center my-12 max-w-1/2 mx-auto">
                    JavaScript is recommended for a better experience.
                </p>
                <div class="flex justify-center my-8 gap-8 max-w-1/2 mx-auto">
                    <a href="{{ route('outline.chapters.index') }}" class="btn">Chapter Timeline</a>
                    <a href="{{ route('outline.codex.index') }}" class="btn">Codex Entries</a>
                </div>
            </div>
        </noscript>
    </div>
@endsection

<script>
    document.addEventListener('alpine:init', () => {
        // alpine store for codex state
        Alpine.store('codex', {
            filter: 'all',
            search: '',
            matches(name) {
                const term = this.search.trim().toLowerCase();
                return term === '' || name.toLowerCase().includes(term);
            }
        })

        // console.log('Alpine init store. Current codex filter:', Alpine.store('codex').filter);
    })
</script>
