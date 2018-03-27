@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="mail/send" method="post">
                        {{ csrf_field() }}
                        <input type="text" name="receipient">
                        <textarea name="content" id="content" cols="30" rows="10">
                        </textarea>
                        <button type="submit">send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
