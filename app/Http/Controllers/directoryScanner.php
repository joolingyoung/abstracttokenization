<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use KamranAhmed\Smasher\Scanner;
use KamranAhmed\Smasher\JsonResponse;

class directoryScanner extends Controller{

public function dirJson() {
       // Instantiate the scanner class while passing the object
       // of which type you need the response. Currently there is
       // only JsonResponse that we have so..
       $scanner = new Scanner(new JsonResponse());
       
       // Scan the directory and return the JSON for the available content
       // $dirJson = $scanner->scan('/directory/to-scan');
       
       // Or you can provide the path at which the json representation should
       // be stored i.e.
       $scanner->scan('./', 'test/dir/path');
    }

    public function jsonDir() {
        // Instantiate the scanner class while passing the object
        // of which representation that you are going to use. We are going
        // to convert JSON back to directory structure
        $scanner = new Scanner(new JsonResponse());

        // Specify the path where you need to populate the content in JSON
        // Let's populate the directory structure in the JSON representation
        // inside the output directory
        $scanner->populate('output/', 'test/json/path');
    }
}