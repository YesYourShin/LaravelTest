<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    public function __construct() {
        // 예외 (index, show)
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    public function show(Request $request, $id) {
        // dd($request->page);
        $page = $request->page;
        $post = Post::find($id);

        return view('posts.show', compact('post', 'page'));

    }

    public function index() {
        // PostsController에 index함수에 내림차순 수정
        // $posts = Post::orderBy('created_at', 'desc')->get();
        // 또는
        // $posts = Post::latest()->get();

        // dd($posts[0]->created_at);

        // 한 페이지에 나오는 개수 설정(latest 붙이면 내림차순)
		// $posts = Post::paginate(2);
		$posts = Post::latest()->paginate(10);
        // dd($posts);

        return view('posts.index', ['posts'=>$posts]);
    }

    public function create() {
        // dd('OK'); //디버깅 할 때 사용
        return view('posts.create');
    }

    public function store(Request $request) {
        // $request->input['title'];
        // $request->input['content'];

        $title = $request->title;
        $content = $request->content;

        $request->validate([
            // 제목 최소 3자
            'title' => 'required|min:3',
            'content' => 'required',

            'imageFile' => 'image|max:2000'
        ]);

        // dd($request);

        // DB에 저장
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;

        // File 처리
        // 내가 원하는 파일시스템 상의 위치에 원하는 이름으로
        // 파일을 저장하고
        if($request->file('imageFile')) {
            $name = $request->file('imageFile')->getClientOriginalName();
            // $name = 'imageFile.jpg';

            $extension = $request->file('imageFile')->extension();
            // $extension = 'jpg';

            $nameWithoutExtension = Str::of($name)->basename('.'.$extension);
            // $nameWithoutExtension = 'imageFile';

            // dd($nameWithoutExtension);
            // dd($name.'extension:'. $extension);
            $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;
            // $fileName = 'imageFlle'.'_'.'1234567890'.'jpg';

            $request->file('imageFile')->storeAs('public/images', $fileName);
            // dd($fileName);
            // $request->imageFile
            // 그 파일 이름을
            $post->image = $fileName;

        }
        
        $post->save();
        // 결과 뷰를 반환
        return redirect('/posts/index');
        // $posts = Post::paginate(5);
        // return view('/posts.index', ['posts'=>$posts]);
        
        
    }

    public function edit($id) {
        

        $post = Post::find($id);
        // $post = Post::where('id', $id)->first();
        // dd($post);
        // 수정 폼 생성
        return view('posts.edit')->with('post', $post);
   }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);

        $post = Post::find($id);
        // 이미지 파일 수정. 파일시스템에서
        // 게시글을 데이터베이스에서 수정
        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();

        return redirect()->route('post.show', ['id'=>$id]);
        
    }


   public function destroy($id) {
       // 파일 시스템에서 이미지 파일 삭제
       // 게시글을 데이버베이스에서 삭제
   }

}