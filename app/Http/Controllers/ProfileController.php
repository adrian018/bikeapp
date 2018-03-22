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
use App\User;


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
     * Show the user profile.
     *
     * @return array $users, $tracks
     */
    
    public function index(){
        $users = Auth::user(); // get the user
        $tracks = Track::find( $users -> id )->tracks;
        
        return view('profile.home', compact( 'users', 'tracks' ) );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function getProfile( $username ) {
        $user = User::where( 'username', $username ) -> first();
        if( !$user ) {
            abort( 404 );
        }

        return view( 'profile.index', compact( 'user' ) );
    }

    /**
     * Edit Profile
     *
     * @return array $users
     */

    public function editProfile() {
        $users = Auth::user(); // get the user
        //return $users;
        return view('profile.edit', compact( 'users' ) ); // poate fi creat un appserviceprovider pentru a micsora redundanta
    }

    /**
     * Update profile
     *
     * @return \Illuminate\Http\Response
     */

    public function updateProfile( Request $request ) {
        $this -> validate( $request, [
            'first_name'  => 'alpha | min:5 | max: 50',
            'first_name'  => 'alpha | min:5 | max: 50',
            'location'    => 'max: 25',
            'avatar' => 'mimes:jpeg, jpg, png | max:1024',

        ] );
       
       
              
        // TODO: verificat daca poza a fost schimbata
        if( $request -> hasFile( 'avatar' ) ) {
                // daca da, variabla $avatar va fi obiectul imaginii
            $avatar = $request -> file( 'avatar' );
                // creaza un sir de caractere formate din secundele UNIX si extensia fisierului
            $filename = time() . '.' . $avatar -> getClientOriginalExtension();
                // muta imaginea in fisierul public/avatars/id-ul utilizatorului
                // cu denumirea din secundele UNIX si extensia originala
            $avatar -> move( 'public/avatars/' . $user -> id,  $filename );
                // seteaza proprietatea avatar al obiectului $request cu noua denumire a fisierului

        } else {
            $filename = $user -> avatar;
        }

        Auth::user() -> update([
            'first_name'    => $request -> first_name,
            'last_name'     => $request -> last_name,
            'location'      => $request -> location,
            'avatar'        => $filename
        ]);

        
        // redirectionare catre pagina profilului
        return redirect( route( 'profile.update' ) );
    }

    public function changePassword() {
        return view( 'profile.changepassword' );
    }


}
