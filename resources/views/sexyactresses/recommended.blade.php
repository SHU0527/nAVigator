<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>検索結果</title>
</head>
<body>
@extends('layouts.app')
@section('content')
<link href="css/styles.css" rel="stylesheet" type="text/css">
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<center>
@if (session('success'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('success') }}
</div>
@endif
<h3>{{ $find_recommended_name['name'] }}に近いAV女優</h3>
女優名をクリックするとその女優の詳細が見れます<br>
管理人イチオシのAV女優をTwitterで紹介する<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="管理人イチオシのAV女優の検索結果だよ♪" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<table>
@foreach ($find_recommended_results as $find_recommended_result)
@if($terminal ==='pc')
<td><a href="{{ route('detail', ['id' => $find_recommended_result['id']]) }}"><img src="{{ asset('/storage/img/' . $find_recommended_result['image_name'])  }}" width="400" height="400"><center> <a href="{{ route('detail', ['id' => $find_recommended_result['id']]) }}">{{ $find_recommended_result['name'] }}</a></center></td>
@else
<tr>
<td><a href="{{ route('detail', ['id' => $find_recommended_result['id']]) }}">{{ $find_recommended_result['name'] }}</a></td>
<td><a href="{{ route('detail', ['id' => $find_recommended_result['id']]) }}"><img src="{{ asset('/storage/img/' . $find_recommended_result['image_name'])  }}" width="200" height="300"></a></td>
</tr>
@endif
@endforeach
</table>
<h3>管理人イチオシのAV女優です♪</h3>
@if($terminal ==='pc')
<center>
<a href="{{ route('detail', ['id' => $admins_recommended_sexyactress['id']]) }}"><img src="{{ asset('/storage/img/' . $admins_recommended_sexyactress['image_name'])  }}" width="400" height="500"></a><br>
<a href="{{ route('detail', ['id' => $admins_recommended_sexyactress['id']]) }}">{{ $admins_recommended_sexyactress['name'] }}</a><br>
<a href="{{ route('recommended.search', ['id' => $admins_recommended_sexyactress['id']]) }}">管理人イチオシのAV女優で更に検索する</a><br>
</center>
@else
<center>
<table>
<td><a href="{{ route('detail', ['id' => $admins_recommended_sexyactress['id']]) }}">{{ $admins_recommended_sexyactress['name'] }}</a></td>
<a href="{{ route('recommended.search', ['id' => $admins_recommended_sexyactress['id']]) }}">管理人イチオシのAV女優で更に検索する</a>
<td><a href="{{ route('detail', ['id' => $admins_recommended_sexyactress['id']]) }}"><img src="{{ asset('/storage/img/' . $admins_recommended_sexyactress['image_name'])  }}" width="200" height="300"></a>
</table>
</center>
@endif
@endsection
</body>
</html>
