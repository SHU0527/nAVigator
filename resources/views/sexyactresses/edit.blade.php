<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>AV女優登録/title>
</head>
<body>
@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('edit', ['id' => $edit_sexyactress->id]) }}" enctype="multipart/form-data">
 {{ csrf_field() }}
<p>カテゴリ-id:<input type="number" name="category_id" value="{{ $edit_sexyactress->category_id }}"></p>
 <p>女優名:<input type="text" name="name" value="{{ $edit_sexyactress->name }}"></p>
<p>画像:<input type="file" name="image"value="{{ $edit_sexyactress->image_name }}"></p>
 <p>女優紹介:<input type="text" name="introduction" value="{{ $edit_sexyactress->introduction }}"></p>
 <p>女優特徴:<input type="text" name="feature"value="{{ $edit_sexyactress->feature }}"></p>
 <p>商品購入ページ:<input type="text" name="purchase_link"value="{{ $edit_sexyactress->purchase_link }}"></p>
 <button type="submit" class="btn btn-primary">編集する</button>
</form>
@endsection
</body>
</html>