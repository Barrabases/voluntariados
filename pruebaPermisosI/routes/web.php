<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Si quieren agregar por ejemplo una barra de navegacion es importante
| que definan bien las rutas
|
| Desde aqui se ven mas que nada todas la rutas del programa
| En caso de haber problemas es importante revisar las rutas
| Revisar las variables
|
*/
//----------------------------------------------------------------------------
//                          Rutas Publicas
//----------------------------------------------------------------------------
Route::get('/', function () { // '/' Es la primera pestaña, luego de esta se agregan el resto, ejemplo '/home'
    return view('welcome');   // Esta es la ruta de la pagina inicial donde tu inicias sesion en principio
});
//----------------------------------------------------------------------------
Route::get('/home', function () { // 'home' Es la pagina donde se encuentra los accesos al dashboard y los posts
    return view('home'); //  
});
//----------------------------------------------------------------------------
//                          Rutas Privadas
//----------------------------------------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); 
//----------------------------------------------------------------------------
//             Aqui se encuentran las rutas de las funciones
//----------------------------------------------------------------------------
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/delete/{id}', [PostController::class, 'destroy'])->name('posts.delete'); //Funcion para eliminar mediante { id }
//----------------------------------------------------------------------------
//               Estas funciones son nativas de laravel
//----------------------------------------------------------------------------
Route::middleware('auth')->group(function () { 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');  //Funcion para editar
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); //Funcion para actualizar
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); //Funcion para eliminar
});
//----------------------------------------------------------------------------
require __DIR__.'/auth.php'; // No tocar!!
//----------------------------------------------------------------------------
