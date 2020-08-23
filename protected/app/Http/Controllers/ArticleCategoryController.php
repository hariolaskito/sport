<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Yajra\Datatables\Datatables;
use Validator;
use App\ArticleCategory;
use Auth;
use Form;
use Carbon\Carbon;

class ArticleCategoryController extends Controller
{
    public function index(){
        $data['title'] = "Kategori Artikel";
        $data['title_desc'] = "Tampilkan semua kategori artikel";
        return view('backend.article_category.view')->with($data);
    }

    public function create(){
        $data['title'] = "Tambah Kategori Artikel";
    	$data['title_desc'] = "";
    	return view('backend.article_category.create')->with($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
        	'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
        	$category = new ArticleCategory;
        	$category->name = $request->name;
			$category->user_id = Auth::user()->id;
            $category->description = "";
        	$category->save();

            $data['response_status'] = 1;
        	$data['response_message'] = 'Kategori artikel berhasil dibuat';
        	return redirect()->route('article_category.index')->with($data);
        }
    }

    public function show(){
        $articles = DB::table('article_category')->select('article_category.name','user.username','article_category.created_at','article_category.id')
		->leftJoin('user','article_category.user_id','=','user.id');
		
        return Datatables::of($articles)
            ->editColumn('created_at', function ($category) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at);
                $date->setTimezone('Asia/Jakarta');
                $txdate = date('d F Y H:i', strtotime($date));
                return $txdate;
            })
			->editColumn('id', function ($category) {
                $html = '<a href="'.route('article_category.edit', ['id' => $category->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
                $html.= Form::open(array('route' => array('article_category.destroy','id' => $category->id), 'method' => 'delete', 'style' => 'display:inline;'));
                $html.='<button type="submit" onclick="confirm(\'Do you want to delete this data?\')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>';
                $html.= Form::close();
                return $html;
            })
            ->setRowId('id')
            ->make(true);
    }

    public function edit($id){
        $data['title'] = "Edit Kategori Artikel";
        $data['title_desc'] = "Edit spesifik kategori artikel";
        $category = ArticleCategory::where('id',$id)->first();
        $data['category'] = $category;
        return view('backend.article_category.edit')->with($data);
    }

    public function update(Request $request, $id){
		$validator = Validator::make($request->all(), [
        	'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = array(
                'name' => $request->name,
                'description' => $request->description
            );
        ArticleCategory::where('id',$id)->update($data);
        $data = array();
        $data['response_status'] = 1;
        $data['response_message'] = 'Kategori artikel berhasil dibuat';
        return redirect()->route('article_category.index')->with($data);
    }

    public function destroy($id){
        $category = ArticleCategory::where('id',$id)->first();
        $category->delete();

        $data['response_status'] = 1;
        $data['response_message'] = 'Kategori artikel berhasil dihapus';
        return redirect()->route('article_category.index')->with($data);
    }
}
