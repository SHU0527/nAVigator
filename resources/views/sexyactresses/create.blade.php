<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>AV女優登録/title>
</head>
<body>
@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('add') }}" enctype="multipart/form-data">
 {{ csrf_field() }}
<p>カテゴリ-id:<input type="number" name="category_id"></p>
 <p>女優名:<input type="text" name="name"></p>
<p>画像:<input type="file" name="image"></p>
 <p>女優紹介:<input type="text" name="introduction"></p>
 <p>女優特徴:<input type="text" name="feature"></p>
 <p>商品購入ページ:<input type="text" name="purchase_link"></p>
 <button type="submit" class="btn btn-primary">登録する</button>
</form>
@endsection
</body>
</html>