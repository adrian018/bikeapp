<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input as Input;
use Auth;
use App\Profile;
use App\Timeline;
use App\Track;


class ProfileController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this -> middleware( 'auth' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index(){
        $users = Auth::user(); // get the user
        $tracks = Track::find( $users -> id )->tracks;
       
        return view('profile.home', compact( 'users', 'tracks' ) );
    }


    public function editProfile() {
        $users = Auth::user(); // get the user
        //return $users;
        return view('profile.edit', compact( 'users' ) ); // poate fi creat un appserviceprovider pentru a micsora redundanta
    }


    public function updateProfile( Request $request ) {

        // creaza o noua instanta a validatorului
        $validator = Validator::make( $request -> all(), [
            // camp optional, doar imagini tip jpeg, jpg, png cu o dimensiune de maxim 1 MB
            'avatar' => 'mimes:jpeg, jpg, png | max:1024',
            // camp obligatoriu, cu o lungime de minim 5 caractere si maxim 50
            'name'  => 'required | min:5 | max: 50',
            // camp obligatoriu, cu o lungime de minim 5 caractere si maxim 50
            'email'  => 'required | min:10 | max: 50',
        ] );

        // verificam daca sunt intrunite conditiile validatorului
        if ( $validator -> fails() ) {
            // daca nu, atunci vom fi redirectionati catre pagina profilului unde vor fi afisate erorile
            return redirect( '/profile' )
                -> withInput()
                -> withErrors( $validator );
        }  else {
            // daca da, atunci profilul va fi actualizat
            $user = Auth::user();
            // verificam daca a fost setata si o poza noua
            if( $request -> hasFile( 'avatar' ) ) {
                // daca da, variabla $avatar va fi obiectul imaginii
                $avatar = $request -> file( 'avatar' );
                // creaza un sir de caractere formate din secundele UNIX si extensia fisierului
                $filename = time() . '.' . $avatar -> getClientOriginalExtension();
                // muta imaginea in fisierul public/avatars/id-ul utilizatorului
                // cu denumirea din secundele UNIX si extensia originala
                $avatar -> move( 'public/avatars/' . $user -> id,  $filename );
                // seteaza proprietatea avatar al obiectului $request cu noua denumire a fisierului
                $user -> avatar = $filename;
            } 

            // update in baza de date; campul avatar e de tip obiect dar pentru a-l putea salva in baza de date, il vom seta ca sir de caractere
            $user -> update( array_merge( $request -> all(), [ 'avatar' => $user -> avatar ] ) );

            // redirectionare catre pagina profilului
            return redirect( '/profile' );
        }

    }

    public function changePassword() {

        return view( 'profile.changepassword' );
    }


}
