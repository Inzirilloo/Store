<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Gate;

//use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//di solito è per gli utenti che voglion comunicare
// con il sito via JSON e non con html bho ok che vogliono
//usare token based authentication
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//posso fare le stesse rotte che in web mhh
use App\Models\User;
use App\Models\Post;
//use GuzzleHttp\Middleware;
/*
Route::get('/post/{post}', function (Post $post) {
    Gate::authorize('view-post', $post);
    return $post;
})->middleware('auth:sanctum');
*/
//allora tu dai tokens e poi il browser se lo piazza nei cookie
// praticamente sto gate funziona che tipo cioe il metodo view fa se 
// i due id matchano allora ritorna true, il metodo authorize non so cosa fa


Route::middleware('auth:sanctum')->post('/post', function () {
    // se il gate non allows lo user to vedere il post cioè gli id non mathchano faccciamo qualcosa
    /*if (!Gate::allows('view-post', $post)) {
        abort(403);
    }
    */
    Gate::authorize('create', Post::class);
    return Post::all();
});

Route::middleware('auth:sanctum')->get('/post/{post}', function (Post $post) {
    // se il gate non allows lo user to vedere il post cioè gli id non mathchano faccciamo qualcosa
    /*if (!Gate::allows('view-post', $post)) {
        abort(403);
    }
    */
    Gate::authorize('view', $post);
    return $post;
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//stiamo dando un argomento ovver :sanctum
//quindi farà l'autenticazione con la sanctum card invece
//che con quella di default
//sancutum card capisc come autenticare lo user con il token based autencazione
Route::get('/dashboard', DashboardController::class)->middleware('auth:sanctum');

//Route::get('/', [AuthController::class, 'show'])->name('login');
