@extends('layouts.app')
@section('title', 'create page')

@section('content')
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">
            <form action="/posts" method="post">
                @csrf
                <div class="form-group">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <label for="exampleFormControlTextarea1">名前</label>
                    <input type="text" class="form-control" name="user_name" id="exampleFormControlTextarea1" rows="3" value="{{old('user_name')}}">

                    <label for="exampleFormControlTextarea1">新規投稿</label>
                    <textarea class="form-control" name="contents" id="exampleFormControlTextarea1" rows="3" >{{old('contents')}}</textarea>
                    <div class="text-center mt-3">
                        <input class="btn btn-primary" type="submit" value="投稿する">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
