@if($column['sortable'])

    <button type="button" wire:click.prefetch="sort('{{ $index }}')" class="btn btn-sm text-left p-0 @if($column['align'] === 'right') d-flex justify-content-end @elseif($column['align'] === 'center') d-flex justify-content-center @endif">

        <span>
            {{ str_replace('_', ' ', $column['label']) }}
        </span>

        <span class="text-xs ml-2">
            @if($sort === $index)
                @if($direction)
                    <span wire:loading.remove>
                        @include('datatables::icons.chevron-up')
                    </span>
                @else
                    <span wire:loading.remove>
                        @include('datatables::icons.chevron-down')
                    </span>
                @endif
            @endif
        </span>
    </button>
@else
    <button type="button" class="btn btn-sm text-left p-0 @if($column['align'] === 'right') d-flex justify-content-end @elseif($column['align'] === 'center') d-flex justify-content-center @endif">
        <span>
            {{ str_replace('_', ' ', $column['label']) }}
        </span>
    </button>
@endif
