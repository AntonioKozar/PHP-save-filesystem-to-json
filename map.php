<?php

class Map
{   
    public $file_name;
    public $file_dir;
    public $file_path;
    public function __construct(string $file_name="", string $file_dir) {
        $this->file_name = $file_name;
        $this->file_dir = $file_dir;
        $this->file_path = $this->file_dir . "/" . $this->file_name;
    }    
    public function save_to_json(){
        $JSON = file_get_contents(__DIR__ . "/res/json/hnp.json");
        $array = json_decode($JSON,true);
        if (!in_array(["name" => $this->file_name, "dir" => $this->file_dir, "path" => $this->file_path], $array) || empty($array)) {
            $array[] = ["name" => $this->file_name, "dir" => $this->file_dir, "path" => $this->file_path];
            $JSON = json_encode($array,JSON_PRETTY_PRINT);
            file_put_contents(__DIR__ . "/res/json/hnp.json",$JSON);
        }
        
    }
}

foreach (array_slice(scandir(__DIR__),2) as $key1) {
    if (strpos($key1,".")) {        
        $MapClass = new Map($key1,str_replace('\\','/',__DIR__));
        $MapClass->save_to_json();
    }
    else {        
        $dir2 = str_replace('\\','/',__DIR__). '/' .$key1;
        foreach (array_slice(scandir($dir2),2) as $key2) {
            if (strpos($key2,".")) {        
                $MapClass = new Map($key2,str_replace('\\','/',$dir2));
                $MapClass->save_to_json();
            }
            else {
                $dir3 = $dir2 . '/' . $key2;
                foreach (array_slice(scandir($dir3),2) as $key3) {
                    if (strpos($key3,".")) {        
                        $MapClass = new Map($key3,str_replace('\\','/',$dir3));
                        $MapClass->save_to_json();
                    }
                    else {
                        $dir4 = $dir3 . '/' . $key3;
                        foreach (array_slice(scandir($dir4),2) as $key4) {
                            if (strpos($key4,".")) {        
                                $MapClass = new Map($key4,str_replace('\\','/',$dir4));
                                $MapClass->save_to_json();
                            }
                            else {
                                $dir5 = $dir4 . '/' . $key4;
                                foreach (array_slice(scandir($dir5),2) as $key5) {
                                    if (strpos($key5,".")) {        
                                        $MapClass = new Map($key5,str_replace('\\','/',$dir5));
                                        $MapClass->save_to_json();
                                    }
                                    else {
                                        var_dump($key5);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
/*
$dir1 = str_replace('\\','/',__DIR__) . '/' . $key;
        foreach (scandir($dir1) as $key1) {
            if (strpos($key1,".")) {        
                $MapClass = new Map($key1,str_replace('\\','/',__DIR__));
                $MapClass->save_to_json();
            }
            else {
                $dir2 = str_replace('\\','/',__DIR__) . '/' . $key1;
                foreach (scandir($dir2) as $key2) {
                    if (strpos($key2,".")) {        
                        $MapClass = new Map($key2,str_replace('\\','/',__DIR__));
                        $MapClass->save_to_json();
                    }
                    else {
                        $dir3 = str_replace('\\','/',__DIR__) . '/' . $key2;
                        foreach (scandir($dir3) as $key3) {
                            if (strpos($key3,".")) {        
                                $MapClass = new Map($key3,str_replace('\\','/',__DIR__));
                                $MapClass->save_to_json();
                            }
                        }
                        
                    }
                }
                
            }
        }

*/

}
$x=file_get_contents(__DIR__ . "/res/json/hnp.json");
                var_dump(json_decode($x));
?>