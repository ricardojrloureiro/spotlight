<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Video extends Model {

	public function getIdsFromReddit() {

        $json = file_get_contents('http://www.reddit.com/r/leagueoflegends/.json?limit=40&after=t3_10omtd/');
        $obj = json_decode($json);

        $ids = [];

        foreach($obj->data->children as $singleObj) { // procura domain a conter youtube
            if ($singleObj->data->media) {
                preg_match(
                    '/y(.){0,1}o(.){0,1}u(.){0,1}t(.){0,1}u(.){0,1}b(.){0,1}e/',
                    $singleObj->data->media->oembed->provider_url, $match);
                if (sizeof($match)) {  // procura o id do video
                    preg_match('/(?:v=)(.){11}/', $singleObj->data->media->oembed->url, $urlMatch);
                    if (sizeof($urlMatch) > 0){
                        $description = 'undefined'; $title = 'undefined';
                        if(isset($singleObj->data->media->oembed->description)) {
                            $description = $singleObj->data->media->oembed->description;
                        }

                        if(isset($singleObj->data->media->oembed->title)) {
                            $title = $singleObj->data->media->oembed->title;
                        }
                        $ids[] = [
                            'id'=> substr($urlMatch[0], 2, 13),
                            'date'=> $singleObj->data->created,
                            'description'=> $description,
                            'title'=> $title
                        ];
                    }
                }
            }
        }
        return $ids;
    }

    public function saveUnexistingVideos($fetchedVideos) {
        foreach($fetchedVideos as $fetched) {
            // ve se encontra na bd o id atual
            $match = Video::where('youtube_id', '=' , $fetched['id'])->get();
            if(sizeof($match)==0){
                $tempVideo = new Video;
                $tempVideo->youtube_id = $fetched['id'];
                $tempVideo->thread_creation = Carbon::createFromTimestamp($fetched['date'])->toDateString();
                $tempVideo->description = $fetched['description'];
                $tempVideo->title = $fetched['title'];
                $tempVideo->save();
            }
        }
    }

    public function getIds() {
        $allVideos = Video::orderBy('id','DESC')->get();
        /**
         * TODO tirar isto daqui e por num metodo
         */
        $ids = '';
        foreach($allVideos as $video) {
            $ids = $ids . "," . $video->youtube_id;
        }

        //remove a 1ª virgula
        $ids = substr($ids,1,strlen($ids));

        return $ids;
    }



    public function getIdsLastWeek() {
        $now = Carbon::now();
        $lastWeek = $now->subWeek();

        $allVideos= Video::orderBy('id','DESC')->where('thread_creation','<',$now)
                                               ->where('thread_creation','>=',$lastWeek)
                                               ->get();
        /**
         * TODO tirar isto daqui e por num metodo
         */
        $ids = '';
        foreach($allVideos as $video) {
            $ids = $ids . "," . $video->youtube_id;
        }

        //remove a 1ª virgula
        $ids = substr($ids,1,strlen($ids));

        return $ids;
    }

    public function getIdsConditionated($queryValues) {
        $allVideos = Video::orderBy('id','DESC')->where('title','like','%'.$queryValues.'%')
                                                ->orWhere('description','like','%'.$queryValues.'%')
                                                ->get();

        /**
         * TODO tirar isto daqui e por num metodo
         */
        $ids = '';
        foreach($allVideos as $video) {
            $ids = $ids . "," . $video->youtube_id;
        }

        //remove a 1ª virgula
        $ids = substr($ids,1,strlen($ids));

        return $ids;
    }
}
