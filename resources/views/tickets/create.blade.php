@extends('templates.main')

@section('title', 'Create ticket')

@section('content')
    <form action="{{ route('tickets.store') }}" method="post">
        @csrf
        <div class="form-group form-group-row">
            <div class="form-group-col">
                <label class="form-label" for="name">You name:</label>
                <input type="text" name="name" id="name" placeholder="Your name...">
            </div>
            <div class="form-group-col">
                <label class="form-label" for="email">You email:</label>
                <input type="email" name="email" id="email" placeholder="Your email...">
            </div>
        </div>
        <div class="form-group form-group-row">
            <div class="form-group-col">
                <label class="form-label" for="title">Title of report:</label>
                <input type="text" name="title" id="title" placeholder="Title of report...">
            </div>

            <div class="form-group-col">
                <label class="form-label" for="category">Category of report:</label>
                <select name="category" id="category">
                    <option disabled selected>Select a category...</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Descriptin about a report:</label>
            <textarea name="description" id="description" cols="30" rows="5" placeholder="Descriptin about a report..."></textarea>
        </div>
        <div class="form-group items-end">
            <input class="button" type="submit" value="Send a report">
        </div>
    </form>
@endsection
