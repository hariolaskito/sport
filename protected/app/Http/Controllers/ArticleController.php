<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Form;
use Validator;
use App\ArticleCategory;
use App\Article;
use Yajra\Datatables\Datatables;
use Auth;
use Carbon\Carbon;

class ArticleController extends Controller
{
    
    public function index(){
        $data['title'] = "Artikel";
        $data['title_desc'] = "Tampilkan Semua Artikel";
        return view('backend.article.view')->with($data);
    }

    public function create(){
        $data['title'] = "Tambah Artikel Baru";
    	$data['title_desc'] = "";
		$data['categories'] = ArticleCategory::select(['id','name'])->get();
    	return view('backend.article.create')->with($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
        	'title' => 'required',
            'content' => 'required',
            'article_category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
        	$article = new Article;
        	$article->title = $request->title;
            /*$unique_slug = false;
            $index_slug = 0;
            $str_slug = $request->title;
            while ($unique_slug == false) {
                if($index_slug > 0){
                    $str_slug = $str_slug."-".$index_slug;
                }
                $oldarticle = Article::where('slug',str_slug($str_slug, "-"))->first();
                if(count($oldarticle) == 0){
                    $article->slug = str_slug($str_slug, "-");
                    $unique_slug = true;
                }else{
                    $index_slug++;
                }
            }*/
        	$article->content = $request->content;
        	$article->article_category_id = $request->article_category_id;
			$article->isactive = $request->isactive;
        	$article->user_id = Auth::user()->id;
			$article->save();

            $data['response_status'] = 1;
        	$data['response_message'] = 'Artikel berhasil dibuat';
        	return redirect()->route('article.index')->with($data);
        }
    }

    public function show(){
        $articles = DB::table('article')->select('article.title','user.username','article.created_at','article.isactive','article.id')
		->leftJoin('user','article.user_id','=','user.id');
        return Datatables::of($articles)
            ->editColumn('created_at', function ($article) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at);
                $date->setTimezone('Asia/Jakarta');
                $txdate = date('d F Y H:i', strtotime($date));
                return $txdate;
            })
            ->editColumn('isactive', function ($article) {
                $html = "";
				if($article->isactive == 1){
					$html = "<span class='label label-success'>Active</span>";
				}else{
					$html = "<span class='label label-danger'>Non Aktif</span>";
				}
				return $html;
            })
			->editColumn('id', function ($article) {
                $html = '<a href="'.route('article.edit', ['id' => $article->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
                $html.= Form::open(array('route' => array('article.destroy','id' => $article->id), 'method' => 'delete', 'style' => 'display:inline;'));
                $html.='<button type="submit" onclick="confirm(\'Apakah anda ingin menghapus data ini?\')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>';
                $html.= Form::close();
                return $html;
            })
            ->setRowId('id')
            ->make(true);
    }

    public function edit($id){
        $data['title'] = "Edit Artikel";
        $data['title_desc'] = "Edit spesifik artikel";
        $article = Article::where('id',$id)->first();
        $data['article'] = $article;
		$data['categories'] = ArticleCategory::select(['id','name'])->get();
        return view('backend.article.edit')->with($data);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'article_category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = array(
                'title' => $request->title,
                'content' => $request->content,
                'article_category_id' => $request->article_category_id,
                'isactive' => $request->isactive
            );
        Article::where('id',$id)->update($data);
        $data = array();
        $data['response_status'] = 1;
        $data['response_message'] = 'Artikel berhasil diupdate';
        return redirect()->route('article.index')->with($data);
    }

    public function destroy($id){
        $article = Article::where('id',$id)->first();
        $article->delete();

        $data['response_status'] = 1;
        $data['response_message'] = 'Artikel berhasil dihapus';
        return redirect()->route('article.index')->with($data);
    }
}
