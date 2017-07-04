<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //header('Access-Control-Allow-Origin: *');
        $csvFilePath = storage_path()."/seed/tag01.csv";
        //
        $fp = fopen( $csvFilePath, 'r' );
        $data = array();
        $row= 0;
        while( $ret_csv = fgetcsv( $fp, 256 ) ){
                for($col = 0; $col < count( $ret_csv ); $col++ ){
                        $data[$row][$col] = $ret_csv[$col];
                }
                $row++;
        }
        fclose( $fp );
        foreach ($data as $key => $value) {
            App\Tag::create(['tag'=>$value[0],'spell1'=>$value[1],'spell2'=>$value[2],'spell3'=>$value[3],'Score'=>$value[4]]);
        }
    }
}
