<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller {

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function view( Request $request ) {
        $posts = Post::with( 'category' )
                     ->when( $request->has( 'archive' ), function ( $query ) {
                         $query->onlyTrashed();
                     } )->get();

        return view( 'home', [ 'posts' => $posts ] );
    }


    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function delete( $id ) {
        $post = Post::findOrFail( $id );
        $post->delete();

        return redirect()->back()->with( 'success', 'Post deleted successfully.' );
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function forceDelete( $id ) {
        $post = Post::onlyTrashed()->findOrFail( $id );
        $post->forceDelete();

        return redirect()->back()->with( 'success', 'Post permanently deleted.' );
    }

    public function restore( $id ) {
        $post = Post::onlyTrashed()->findOrFail( $id );
        $post->restore();

        return redirect()->back()->with( 'success', 'Post restore successfully.' );
    }
}
