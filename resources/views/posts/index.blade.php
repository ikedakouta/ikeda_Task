@extends('layouts.app')
@section('title', 'TOP page')

@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="create_btn">

        </div>

        <div id="search">
            <form action="{{url('/posts/search')}}" method="get" class="form-inline my-2 my-lg-0 ml-2">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                <input type="search" class="form-control mr-sm-2" name="search"  value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">



                </div>
                <input type="submit" value="検索" class="btn btn-info">
            </form>
        </div>
        <div class="col-10 col-md-8 offset-1 offset-md-2">


            <table class="table">
                <tbody>
                        <tr>
                        <th>名前</th>
                        <th colspan="3">内容</th>
                    </tr>

                    @foreach ($posts ?? '' as $post)
                    <tr>
                        <td>{{ $post->user_name }}</td>
                        <td>{{ $post->contents }}</td>
                        <td>{{ $post->created_at }}</td>


                        <td>
                            <a href="{{ url('posts/'.$post->id) }}" class="btn btn-success">詳細</a>
                         @auth
                            <form action="/posts/delete/{{$post->id}}" method="POST">
                                {{ csrf_field() }}
                                <input type="submit" value="削除" class="btn btn-danger post_del_btn">
                            </form>
                        @endauth
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <p>
                {{$result ?? ''}}
            </p>
        </div>
    </div>
</div>
@endsection
