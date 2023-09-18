<?php

namespace App\Http\Controllers\admin_dashboard\tutor\kelasku;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Kelas;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas_id)
    {
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrfail($kelas_id);
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        return view('admin_dashboard.tutor.kelasku.forum.index', ['kelas' => $kelas, 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kelas_id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required'
        ]);
        
        $data = $request->all();
        
        $data['kelas_id'] = $kelas_id;
        $data['user_id'] = Auth::user()->id;

        Post::create($data);
        
        return redirect()->route('tutor.kelasku.forum.index', $kelas_id)->with('status', 'Forum diskusi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kelas_id, $id)
    {
        $kelas = Kelas::where('tutor_id', Auth::user()->id)->findOrfail($kelas_id);
        $post = Post::findOrFail($id);
        $comment = Comment::where('post_id', '=', $id)->get();
        // $post = PostsViews::where('titleslug', '=' ,$titleslug)->firstOrFail();

        // PostsViews::createViewLog($post);

        return view('admin_dashboard.tutor.kelasku.forum.show', ['kelas' => $kelas, 'post' => $post, 'comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas_id, $id)
    {
        $this->validate($request, [
            'isi' => 'required',
        ]);

        $data = $request->all();

        $post = Post::findOrFail($id);

        $post->update($data);

        return redirect()->route('tutor.kelasku.forum.show', [$kelas_id, $id])->with('status', 'Postingan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas_id, $id)
    {
        $post = Post::with('comment')->findOrFail($id);
        
        if ($post->comment->count() > 0) {
            foreach($post->comment as $item){
                $item->delete();
            }
        }
        
        $post->delete();
        
        return response()->json(array('success' => true));
    }

    public function commentStore(Request $request, $kelas_id, $post_id){
        $this->validate($request, [
            'isi' => 'required',
        ]);

        Comment::create([
            'post_id' => $post_id,
            'user_id' => Auth::user()->id,
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('status', 'Berhasil membuat forum diskusi baru');
    }

    public function commentUpdate(Request $request, $kelas_id, $post_id, $id)
    {
        $this->validate($request, [
            'isi' => 'required',
        ]);

        $data = $request->all();

        $comment = Comment::findOrFail($id);

        $comment->update($data);

        return redirect()->back()->with('status', 'Postingan berhasil diperbarui');
    }

    public function commentDestroy($kelas_id, $post_id, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(array('success' => true));
    }
}
