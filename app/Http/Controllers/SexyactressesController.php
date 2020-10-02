<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use  App\SexyActress;
use  App\UnregisteredSexyActress;
class SexyactressesController extends Controller
{
	public function index(Request $request) {
		$user_agent =  $request->header('User-Agent');
		if ((strpos($user_agent, 'iPhone') !== false)
				|| (strpos($user_agent, 'iPod') !== false)
				|| (strpos($user_agent, 'Android') !== false)) {
			$terminal ='mobile';
		} else {
			$terminal = 'pc';
		}
		return view('sexyactresses.index', compact('terminal'));
	}
	public function create(Request $request) {
		$this->validate($request, [
		'name' => 'required|min:2']);
		$name = $request->input('name');
		$find_name = SexyActress::where('name', 'like', '%' . $name . '%')->first();
		if (!$find_name) {
			UnregisteredSexyActress::create(['name' => $name]);
			return redirect('/')->with('flash_message', '未登録のAV女優です。反映までもうしばらくお待ちください');
		} else {
			$find_name->increment('searched_count', 1);
			$find_id = $find_name->category_id;
			$find_results = SexyActress::where('category_id', $find_id)->inRandomOrder()->take(5)->get();
			$recommended_sexyactress = SexyActress::where('category_id', '!=', $find_id)->inRandomOrder()->first();
		}
		$user_agent =  $request->header('User-Agent');
		if ((strpos($user_agent, 'iPhone') !== false)
				|| (strpos($user_agent, 'iPod') !== false)
				|| (strpos($user_agent, 'Android') !== false)) {
			$terminal ='mobile';
		} else {
			$terminal = 'pc';
		}
		return view('sexyactresses.display', compact('find_name', 'find_results', 'recommended_sexyactress', 'terminal'));

	}
	public function getCreateForm() {
	return view('sexyactresses.create');
	}
	public function addSexyActresses(Request $request) {
	$sexy_actresses = new SexyActress;
	$sexy_actresses->category_id = $request->category_id;
	$sexy_actresses->name = $request->name;
	$path = $request->image->store('public/img');
	$sexy_actresses->image_name = basename($path);
	$sexy_actresses->introduction = $request->introduction;
	$sexy_actresses->feature = $request->feature;
	$sexy_actresses->purchase_link = $request->purchase_link;
	$sexy_actresses->save();
	if ($sexy_actresses->save()) {
		return redirect('/home')->with('flash_message', '女優の登録に成功しました');
	} else {
		return redirect('/home')->with('flash_message', '女優の登録に失敗しました');
	} 

	return view('home');
	}
	


	public function recommendedSearch(Request $request, $id) {
		$find_recommended_name = SexyActress::where('id', $id)->first();
		$find_recommended_id = $find_recommended_name->category_id;	
		$find_recommended_results = SexyActress::where('category_id', $find_recommended_id)->inRandomOrder()->take(5)->get();	
		$admins_recommended_sexyactress = SexyActress::where('category_id', '!=', $find_recommended_id)->inRandomOrder()->first();
		$user_agent =  $request->header('User-Agent');
		if ((strpos($user_agent, 'iPhone') !== false)
				|| (strpos($user_agent, 'iPod') !== false)
				|| (strpos($user_agent, 'Android') !== false)) {
			$terminal ='mobile';
		} else {
			$terminal = 'pc';
		}
		return view('sexyactresses.recommended', compact('find_recommended_name', 'find_recommended_results', 'admins_recommended_sexyactress', 'terminal'));

	}
	public function detail($id) {
			$detail = SexyActress::where('id', $id)->first();
			return view('sexyactresses.detail', compact('detail'));
	}
	public function display() {
		return redirect(route('index'));
	}
	public function showEditForm($id) {
		$edit_sexyactress = SexyActress::where('id', $id)->first();
		return view('sexyactresses.edit', compact('edit_sexyactress'));
	}
	public function edit($id, Request $request) {
		$detail_edit = SexyActress::find($id);
		$this->validate($request,['image' => 'required|image']);
		$path = $request->file('image')->store('public/img');
		$detail_edit->image_name = basename($path); 
		$detail_edit->category_id = $request->category_id;
		$detail_edit->name = $request->name;
		$detail_edit->introduction = $request->introduction;
		$detail_edit->feature = $request->feature;
		$detail_edit->purchase_link = $request->purchase_link;
		$detail_edit->save();
		return redirect(route('detail', ['id' => $id]))->with('flash_message', '女優の編集が完了しました');
	}
	
}
