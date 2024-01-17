<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    //
    public function show()
    {
        return view('welcome');
    }

    //con questo metodo dei cookie ce una cosa importante da ricordare
    //che dopo due ore di inattivita devi loggare di nuovo perche expired i cookie
    //quindi l'id che ciai te lo tolgono
    //puoi fare una prova facendo partire loggando andando su ispezione
    //andando su cookie e tolgiere il cookie di laravel praticamente 
    //è quello che succede due ore dopo se non fai niente
    // ma se metti un altra variabile quindi la remember me non succede 
    // forse perchè è una roba fuori dal database? e quindi l'id non è
    //collegato ai record mhhh

    public function login()
    {
        validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();
        //only() excratc robe da password e email
        //poi lo passa al attempt method che ritorna true se
        //le credenziali so corrette
        // SE VUOI FARLO CON SESSION E NON CON TOKEN
        if (auth()->attempt(
            request()->only(['email', 'password']),
            request()->filled('remember')
            //se remmber è checcato allora filled ritornerà true
        )) {
            return redirect('/list');
        }
        return redirect()->back()->withErrors(['email' => 'credenziali invalidi']);
    }


    public function logout()
    {

        auth()->logout();
        //questp rimuovera l'id corrente che 
        //è piazzato nella session dalla id della session
        /*
        auth()->logout();
        return redirect('/');
        */
        /*
        // per farlo con TOKEN
        auth()->user()->currentAccessToken()->delete();
*/
        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function registration()
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
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required',
                ],
            );

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->admin = false;
        $user->save();
        return redirect('/');
    }

    public function admin_index()
    {
        $this->authorize('admin');
        $products = Product::orderByDesc('created_at')
            //posso fare with('user) perce ho fatto belongs to in product
            //with('user') sta chiamando il emtodo che ho fatto io nel modello
            //product
            ->with('user')
            ->get();
        //$product = Product::all();
        return view('admin.index', compact('products'));
    }
}
