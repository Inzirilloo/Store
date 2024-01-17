<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function list()
    {
        //Product::user($this); posso farlo se faccio il emtood user statico
        //
        $products = Product::orderByDesc('created_at')
            //posso fare with('user) perce ho fatto belongs to in product
            //with('user') sta chiamando il emtodo che ho fatto io nel modello
            //product
            ->with('user')
            ->get();
        //$product = Product::all();
        return view('list', compact('products'));
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
                    'name' => ['string'],
                    'content' => ['string'],
                    'price' => ['numeric'],
                ],
            );
        $product = new Product();
        $product->user_id = $request['user_id'];
        $product->content = $request['content'];
        $product->name = $request['name'];
        $product->price = $request['price'];

        //dd($persona);
        $product->save();
        //Product::create([$request]);
        return redirect('/list');
    }
    /*
    public function edit($product)
    {
        $product = Product::find($product);
        return view('edit', compact('product'));
    }
*/  //tu gli passi un id ma tu facendo cosi dici a laravel di trovare 
    // l'oggetto product con quel id
    public function edit(Product $product)
    {
        $this->authorize('edit', $product);
        return view('edit', compact('product'));
    }

    public function update(Product $product)
    {
        $this->authorize('update', $product);
        $product->content = request('content');
        $product->update();
        return redirect('/list');
    }
    /*
public function update(Product $product)
    {
        $request = request()
            ->validate(
                [
                    'content' => ['string']
                ],
            );
        $product->update($request);
        return redirect('/');
    }
    */
    public function destroy(Product $product)
    {
        $this->authorize('destroy', $product);
        $product->delete();
        return redirect('/list');
    }
}
