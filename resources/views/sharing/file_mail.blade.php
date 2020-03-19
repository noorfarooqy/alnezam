@extends('mail.layout')

@section('mail-body')
    <div class="card">
        <div class="card-head">
            Shared file
        </div>
        <div class="card-body">
            <div class="row">
                Al Nezam al Asasy has shared a file with you.
            </div>

            <div class="row">
                Click on the button below. If the button does not work copy the link below to your browser
            </div>
            <div class="row">
                <a href="{{env('APP_URL')}}/trip/shared/{{$shared_id}}/{{$file_id}}">View file</a>
            </div>
            <br>
            <br>
            <div class="row">
                {{env('APP_URL')}}/{{"trip/$file_id"}} 
            </div>
        </div>
    </div>
@endsection