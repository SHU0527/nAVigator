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
@if($terminal ==='pc')
<h3>{{ $find_name['name'] }}に近いAV女優</h3>
女優名をクリックするとその女優の詳細が見れます
<table>
@foreach ($find_results as $find_result)
<td><a href="{{ route('detail', ['id' => $find_result['id']]) }}"><img src="{{ asset('/storage/img/' . $find_result['image_name'])  }}" width="400" height="400"><center> <a href="{{ route('detail', ['id' => $find_result['id']]) }}">{{ $find_result['name'] }}</a></center></td>
@endforeach
</table>
@else
<h6>{{ $find_name['name'] }}に近いAV女優</h6>
女優名をクリックするとその女優の詳細が見れます
<table>
@foreach ($find_results as $find_result)
<tr>
<td><a href="{{ route('detail', ['id' => $find_result['id']]) }}">{{ $find_result['name'] }}</a></td>
<td><a href="{{ route('detail', ['id' => $find_result['id']]) }}"><img src="{{ asset('/storage/img/' . $find_result['image_name'])  }}" width="200" height="300"></a></td>
</tr>
@endforeach
</table>
@endif
@if($terminal ==='pc')
<h3>管理人イチオシのAV女優です♪</h3>
<center>
<a href="{{ route('detail', ['id' => $recommended_sexyactress['id']]) }}"><img src="{{ asset('/storage/img/' . $recommended_sexyactress['image_name'])  }}" width="400" height="400"></a><br>
<a href="{{ route('detail', ['id' => $recommended_sexyactress['id']]) }}">{{ $recommended_sexyactress['name'] }}</a><br>
<a href="{{ route('recommended.search', ['id' => $recommended_sexyactress['id']]) }}">管理人イチオシのAV女優で更に検索する</a><br>
</center>
@else
<h6>管理人イチオシのAV女優です♪</h6>
<center>
<table>
<td><a href="{{ route('detail', ['id' => $recommended_sexyactress['id']]) }}">{{ $recommended_sexyactress['name'] }}</a></td>
<a href="{{ route('recommended.search', ['id' => $recommended_sexyactress['id']]) }}">管理人イチオシのAV女優で更に検索する</a><br>
<td><a href="{{ route('detail', ['id' => $recommended_sexyactress['id']]) }}"><img src="{{ asset('/storage/img/' . $recommended_sexyactress['image_name'])  }}" width="200" height="300"></a><br>
</table>
</center>
@endif
@endsection
</body>
</html>
