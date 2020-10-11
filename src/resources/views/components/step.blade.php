<a href="{{ route('step.show', $step->id) }}" class="c-panel">
    <div class="c-panel__head">
        <h2 class="c-panel__title">{{ convert_string($step->title) }}</h2>
        <span class="c-panel__category">{{ $step->category->name }}</span>
        <vue-from-now :date="{{ $step->created_at }}" class-name="c-panel__fromNow"></vue-from-now>

        <div class="c-panel__body">
            {{ convert_string($step->description) }}
        </div>
    </div>{{-- </.c-panel__head> --}}
</a>{{-- </.c-panel> --}}