<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function list()
    {
        //Post::user($this); posso farlo se faccio il emtood user statico
        //
        $posts = Post::orderByDesc('created_at')
            //posso fare with('user) perce ho fatto belongs to in post
            //with('user') sta chiamando il emtodo che ho fatto io nel modello
            //post
            ->with('user')
            ->get();
        //$post = Post::all();
        return view('list', compact('posts'));
    }

    public function create()
    {
        //$users = User::all();
        return view('create'/*, compact('users')*/);
    }

    public function store()
    {
        $request = request()
            ->validate(
                [
                    // il metodo exist della classe Rule
                    // accetta il nome della tabella come parametro e la colonna
                    // vede se user_id ha un valore che esiste nella tabella
                    // cioe metti caso che ci sono 100 users ma in un qualche modo
                    // dal form arriva 101 visto che deve esistere lo user 101 per fare la
                    // relazione ti fa un check se esiste prima
                    'user_id' => ['integer', Rule::exists('users', 'id')],
                    'content' => ['string']
                ],
            );
        $post = new Post();
        $post->user_id = $request['user_id'];
        $post->content = $request['content'];
        //dd($persona);
        $post->save();
        //Post::create([$request]);
        return redirect('/list');
    }
    /*
    public function edit($post)
    {
        $post = Post::find($post);
        return view('edit', compact('post'));
    }
*/  //tu gli passi un id ma tu facendo cosi dici a laravel di trovare 
    // l'oggetto post con quel id
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);
        $post->content = request('content');
        $post->update();
        return redirect('/list');
    }
    /*
public function update(Post $post)
    {
        $request = request()
            ->validate(
                [
                    'content' => ['string']
                ],
            );
        $post->update($request);
        return redirect('/');
    }
    */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);
        $post->delete();
        return redirect('/list');
    }
}
