<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Video;
use Request;

class PagesController extends Controller {

	public function index() {

        $video = new Video;
        $videosIds = $video->getIds();

        return view('pages.index',['videosIds'=>$videosIds]);
    }

    public function lastWeek() {

        $video = new Video;
        $videosIds = $video->getIdsLastWeek();
        if($videosIds==false){
            $videosIds = $video->getIds();
        }

        return view('pages.index',['videosIds'=>$videosIds]);
    }

    public function search() {
        $video = new Video;
        $videosIds = $video->getIdsConditionated(Request::get('data'));

        if($videosIds==false){
            $videosIds = $video->getIds();
        }

        return view('pages.index',['videosIds'=>$videosIds]);
    }
}
