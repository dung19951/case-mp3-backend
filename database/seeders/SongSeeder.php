<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $song = new Song();
        $song->song_name = 'Người yêu cũ';
        $song->category_id = 1;
        $song->lyric = '';
        $song->song_image = 'https://lyricvn.com/wp-content/uploads/2019/11/a5bce353e03817973c6fa39689cec2da_1362473102.jpg';
        $song->path= 'https://firebasestorage.googleapis.com/v0/b/dung-bc677.appspot.com/o/audio%2F1630598239527?alt=media&token=cdc5039a-20a6-403e-8cd2-c317ddf4ade8';
        $song->album = 'album Nhạc của Phan Mạnh Quỳnh';
        $song->author = 'Phan Mạnh Quỳnh';
        $song->view_count = 0;
        $song->like = 0;
        $song->unlike = 0;
        $song->singer_id = '5';
        $song->save();
    }
}
