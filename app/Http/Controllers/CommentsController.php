<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeline;
use App\Comment;


class CommentsController extends Controller
{
    public function store( Timeline $timeline ) {

    	$timeline -> addComment(request(  array( 'comment', 'timeline_id', 'user_id' ) ) );

	/*	$comment = new Comment();

		$comment -> user_id = $request -> user_id;
		$comment -> timeline_id = $request -> timeline_id;
		$comment -> comment = $request -> comment;
		$comment -> save();*/

		return  redirect( '/timeline' );
	}

}
