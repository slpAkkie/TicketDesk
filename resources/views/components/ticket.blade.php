<div class="ticket">
    <h3 class="ticket__title">{{ $t->title }} <span class="ticket__category">({{ $t->category->title }})</span></h3>
    <p class="ticket__short-description">{{ $t->shortDescription() }}</p>
    <footer class="ticket__footer">
        <p class="ticket__created-at">Created at {{ $t->created_at }}</p>
        @if ($t->canBeAccepted())
            <form class="mt-2" action="{{ route('tickets.accept', $t) }}" method="post">
                @csrf
                @method('put')
                <input class="button" type="submit" value="Accept">
            </form>
        @endif
    </footer>
</div>
