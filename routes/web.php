<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\LogoutController; 
use App\Http\Controllers\PasswordController; 
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\NotificationController;
use App\Models\Notification;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
#Cache command: php artisan config:clear or php artisan route:clear

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//Get Arguments --> get(route,NameController::class) || get(route[NameController::class,'functionController'])
//Ex: Route::get('equipos/create',[EquipoController::class,'create']); 
//Route::post('logout', [LogoutController::class,'logout'])->name('logout.index');
//return view('welcome');
//HomeController 
Route::get('/', HomeController::class);

// < Routes accessible only to unauthenticated users >
Route::middleware(['guest'])->group(function () { 
    //LoginController (App\Http\Controllers\LoginController)
    Route::get('login', [LoginController::class,'index'])->name('login.index');
    Route::post('login', [LoginController::class,'user_login'])->name('login.user');
    //Reset Password Accont
    Route::get('login/recover', [LoginController::class,'recover_show'])->name('login.recover');
    Route::post('login/recover', [LoginController::class,'recover_accont'])->name('login.accont');
    Route::get('reset-password/{token}', [PasswordController::class,'create'])->name('password.reset');
    Route::post('reset-password', [PasswordController::class,'store'])->name('password.update');
    //RegisterController (App\Http\Controllers\RegisterController)
    Route::get('register', [RegisterController::class,'index']);
    Route::post('register', [RegisterController::class,'register'])->name('register_user');
});

#--------------------------------------------------------------------------------------------------

   // < Routes accessible only to authenticated users >
Route::middleware(['auth'])->group(function () {
    
    Route::post('notification/equipos/{id}', [NotificationController::class,'index'])->name('notification.index');
    Route::post('notification/torneos/{id}', [NotificationController::class,'torneo'])->name('notification.torneo');
    Route::post('notification/participantes/{id}', [NotificationController::class,'participante'])->name('notification.participante');
    Route::get('notification/show', [NotificationController::class,'show'])->name('notification.show');
    Route::post('notification', [NotificationController::class,'send'])->name('notification.send');
    //DashboardController (App\Http\Controllers\DashboardController)
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard.index');
    Route::get('dashboard/nosotros', [DashboardController::class,'nosotros'])->name('dash_nosotros');
    Route::get('dashboard/home', [DashboardController::class,'home'])->name('dash_home');
    Route::post('dashboard/home', [DashboardController::class,'home'])->name('dash_home');
    Route::get('dashboard/torneos/{torneo}', [DashboardController::class,'torneo'])->name('dashboard.torneo');
    Route::get('dashboard/equipos/{equipo}', [DashboardController::class,'equipo'])->name('dashboard.equipo');
    
    //LogoutController (App\Http\Controllers\LogoutController)
    Route::post('dashboard', [LogoutController::class,'logout'])->name('logout.index');
    //EquipoController (App\Http\Controllers\EquipoController)
    
    //Edit User
    Route::get('login/edit/{userID}',[LoginController::class,'user_edit'])->name('user.edit');
    Route::put('login/edit/{userID}',[LoginController::class,'user_update'])->name('user.update');
    Route::get('dashboard/slide', [DashboardController::class,'slidebar'])->name('slide.index');

    //Route View Us
     //Shows a view that will not interact with the database
    Route::controller(EquipoController::class)->group(function(){ //Group EquipoController get(route,functionController)
            Route::get('equipos' , 'index')->name('equipos.index');
            Route::get('equipos/create','create')->name('equipos.crear');
            Route::post('equipos/create','store')->name('store');    
            //Protected views for the "Representante" rol using middleware 
            Route::get('equipos/{equipo}','show')->name('equipos.show'); 
            Route::get('equipos/{equipo}/edit','edit')->name('equipos.edit')->middleware('representante');
            //---------------------------------------------------------------------------------------------
            Route::put('equipos/{equipo}','update')->name('equipos.update');             //Update "route::put"
            //Teams members
            Route::get('equipos/{equipo}/miembros','miembros')->name('equipos.miembros');
            Route::post('equipos/{equipo}/miembros','miembros_store')->name('equipos.store');   
            Route::get('equipos/miembros/{equipo}/{miembro}','miembros_show')->name('miembros_show');          //Update "route::put"
            Route::delete('equipos/{equipo}','destroy')->name('equipos.destroy'); //Delete "route::delete"
            
    });
    Route::controller(TorneoController::class)->group(function(){ //Group TorneoController get(route,functionController)
        Route::get('torneos' , 'index')->name('torneos.index');
        Route::get('torneos/create','create')->name('torneos.crear');
        Route::post('torneos/create','store')->name('store');    
        //Protected views for the "Organizador" rol using middleware 
        Route::get('torneos/{torneo}','show')->name('torneos.show');
        Route::get('torneos/{torneo}/edit','edit')->name('torneos.edit')->middleware('organizador');
        //---------------------------------------------------------------------------------------------
        Route::put('torneos/{torneo}','update')->name('torneos.update');             //Update "route::put"
        Route::delete('torneos/{torneo}','destroy')->name('torneos.destroy'); //Delete "route::delete"

       //Tournament teams
        Route::get('torneos/equipos/agregar/{torneo}','equipos_torneo')->name('equipos.torneo');
        Route::post('torneos/equipos/agregar/{torneo}','equipos_store')->name('torneos.store'); 
       //Tournament participants
        Route::delete('torneos/participantes/destroy/{torneo}','participantes_destroy')->name('participantes.destroy'); //Delete "route::delete"
        Route::get('torneos/participantes/agregar/{torneo}','participantes_torneo')->name('participantes.torneo');
        Route::post('torneos/participantes/agregar/{torneo}','participantes_store')->name('participantes.store'); 
    });

    Route::controller(EstadisticaController::class)->group(function(){ //Group TorneoController get(route,functionController)
        Route::get('estadisticas' , 'index')->name('estadisticas.index');
        Route::post('estadisticas/create','store')->name('store');    
        //Protected views for the "Organizador" rol using middleware 
        Route::get('estadisticas/{torneo}','show')->name('estadisticas.show'); 
        Route::get('estadisticas/{torneo}/edit','edit')->name('estadisticas.edit');
        //---------------------------------------------------------------------------------------------
        Route::put('estadisticas/{torneo}','update')->name('estadisticas.update');             //Update "route::put"
        Route::delete('estadisticas/{torneo}','destroy')->name('estadisticas.destroy'); //Delete "route::delete"
    });
  
    Route::controller(PartidoController::class)->group(function(){ //Group TorneoController get(route,functionController)
        Route::post('partidos/create/{torneoID}','store')->name('partidos.store');    
        Route::get('partidos/{torneoID}','index')->name('partidos.index');
        Route::get('partidos/create/{torneoID}','create')->name('partidos.crear');
        Route::get('partidos/edit/{partido}/{torneoID}','edit')->name('partidos.edit')->middleware('organizador'); 
        Route::get('partidos/index/{partido}/{torneoID}','show')->name('partidos.show'); 
        Route::delete('partidos/index/{partido}/{torneoID}','destroy')->name('partidos.destroy'); 
        //---------------------------------------------------------------------------------------------
        Route::put('partidos/edit/{partido}/{torneoID}','update')->name('partidos.update');             //Update "route::put"        
    });
});
