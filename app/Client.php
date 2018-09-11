<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Core\ServiceBuilder;

class Client extends Model
{
    //

	public function orders(){

		return $this->hasMany('App\Order');
	}


    public static function uploadFile($filePath, $fileName){

        $path = 'https://storage.googleapis.com/cvmama/courier-214811-34543e773b7c.json';
        // Authenticate using a keyfile path
        
        


        $storage = new StorageClient([
            'projectId'=> 'courier-214811',
            'keyFile' => json_decode(file_get_contents($path), true)
        ]);

        $bucket = $storage->bucket('cvmama');

        

        // Using Predefined ACLs to manage object permissions, you may
        // upload a file and give read access to anyone with the URL.
        $bucket->upload(
            fopen($filePath, 'r'),
            [
                'predefinedAcl' => 'publicRead',
                'name'=>$fileName
            ]
        );

        $url = "https://storage.googleapis.com/cvmama/".$fileName;

        return $url;

    }
}
