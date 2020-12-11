<?php


function validateImg(string $url): bool{
    
    $cast = [
        "FileSize" => "1024",
        "FileType" => "2",
        "MimeType" => "image/jpeg"
        ];
    
    $file = exif_read_data($url, "ANY_TAG");
    
    foreach ($file as $key => $value) {
        
        if ($value !== $cast[$key]) {
            return false;
        }
        
    }
    
    return true;
    
}