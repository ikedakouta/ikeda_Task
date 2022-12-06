@extends('layouts.app')
@section('title', 'TOP page')

@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->

        <div id="search">
            <form action="list.php" method="post">
                <input type="search" name="search" placeholder="ユーザー名で検索">
                <button type="submit" name="submit" value="">🔍</button>
            </form>
        </div>
        <div class="col-10 col-md-8 offset-1 offset-md-2">
            <table class="table">
                <tbody>
                        <tr>
                        <th>名前</th>
                        <th colspan="3">内容</th>
                    </tr>

                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->user_name }}</td>
                        <td>{{ $post->contents }}</td>
                        <td>{{ $post->created_at }}</td>


                        <td>
                            <a href="{{ url('posts/'.$post->id) }}" class="btn btn-success">編集</a>
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
        </div>
    </div>
</div>
@endsection
