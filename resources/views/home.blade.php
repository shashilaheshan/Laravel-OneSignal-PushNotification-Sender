@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div >

                         @if($menu)

                             @foreach($menu as $item)
                               <h1> {{$item['name']}}</h1><br>
                                 @foreach($submenu as $su)
                                     @if($item['id']==$su['cat_code'])
                                     <li>{{$su['name']}}</li>
                                         @else
                                         <li></li>
                                   @endif
                                 @endforeach

                           @endforeach
                        @endif
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
