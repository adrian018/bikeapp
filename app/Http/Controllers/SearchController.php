<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function getResults( Request $request ) {

    	$query = $request -> s;
    	if( !$query ) {
    		return redirect() -> route( 'timline' );
    	}

    	$users = User::where( DB::raw( "CONCAT( first_name, ' ', last_name )" ), 'LIKE', "%{$query}%" ) // concatenare nume si prenume daca exista
    		-> orWhere( 'username', 'LIKE', "%{$query}%" )
    		->get();
    	
    	return view( 'search.results', compact( 'users' ) );
    }
}
