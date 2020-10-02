<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>女優詳細</title>
</head>
<body>
@extends('layouts.app')
@section('content')
<center>
@if(Auth::check())
<a href="{{ route('detail.edit', ['id' => $detail->id]) }}">編集する</a>
@endif
<h3>{{ $detail->name }}の詳細</h3>
<img src="{{ asset('/storage/img/' . $detail->image_name)  }}" width="300" height="400">
<diV>
{{ $detail->introduction }}<br>
この女優の特徴:{{ $detail->feature }}<br>
<a href="{{ $detail->purchase_link }}">この女優の作品を見る</a><br>

</div>
</center>
@endsection
</body>
</html>
