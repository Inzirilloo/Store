<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __invoke()
    {

        //user() estra lo user il current user
        //loggato
        // RETURN VIEW PER LA SESSION
        //return view('dashboard', [
        return view('dashboard', [
            //stanno avvenendo cose nella session
            'user' => auth()->user()
            //dopo il logout atuh()->user() ritornerà null
            //quindi quando fai $user->name nella dashboard dice cosa?
            //quindi in realtà fin qua anche se non sei loggato ci arrivi
            //devo fare in modo che tu non arrivi nemmeno qua quindi metto
            //un controllo NELLA ROTTA CIOE IUN MIDDLEWARE
        ]);
    }
}
