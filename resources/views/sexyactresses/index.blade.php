<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>あなたの好きなAV女優がわかるAV新検索</title>
</head>
@extends('layouts.app')
@section('content')
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
@if($terminal ==='pc')
<center>
<h4>あなたの好きなAV女優を教えてください</h4>
そろそろ他のAV女優も見てみたいな？って思った時はnAVigatorで検索!<br>
あなたの好きな女優さんから似ているAV女優を教えます!<br>
<font color="gray">※ログイン・新規登録は必要ありません</font>
<form method="post" action="{{ route('index') }}">
{{ csrf_field() }}
<input type="text" name="name" class="form-control input-sm" placeholder="AV女優名を検索" />
<button type="submit" class="btn btn-primary">検索</button>
</form>
<span class="help-block">{{$errors->first('name')}}</span>
</center>
@else
<center>
あなたの好きなAV女優を入力して下さい!<br>
関連するAV女優を検索出来ます<br>
<font color="gray">※ログイン・新規登録は必要ありません</font>
<form method="post" action="{{ route('index') }}">
 {{ csrf_field() }}
 <input type="text" name="name" class="form-control input-sm" placeholder="AV女優名を検索" />
 <button type="submit" class="btn btn-primary">検索</button>
</form>
 <span class="help-block">{{$errors->first('name')}}</span>
 </center>
@endif
@endsection
</body>
</html>
