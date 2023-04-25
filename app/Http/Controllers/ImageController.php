<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function fixedImage(Request $request): void
    {
        $inputFilePath = 'C:\Users\aleks\Downloads\corrupt.bmp';
        $outputFilePath = public_path('test69FORTHEWIN.bmp');

        $inputFile = fopen($inputFilePath, 'rb');

        $outputFile = fopen($outputFilePath, 'wb');

        $header = fread($inputFile, 54);

        fwrite($outputFile, $header);

        fseek($inputFile, 2);
        $imageSize = unpack('V', fread($inputFile, 4))[1];

        $chunkSize = 1024;
        $bytesProcessed = 54;

        while ($bytesProcessed < $imageSize) {
            $chunk = fread($inputFile, $chunkSize);
            fwrite($outputFile, $chunk);
            $bytesProcessed += $chunkSize;
        }

        fclose($inputFile);
        fclose($outputFile);


        //     $images = $request->file('images');
//
//        $fixedImages = [];
//
//        error_log($images);
//
//        foreach ($images as $image) {
//            $inputFilePath = $image->getPathname();
//            $inputFile = fopen($inputFilePath, 'rb');
//            $imageData = fread($inputFile, filesize($inputFilePath));
//            fclose($inputFile);
//
//            $fixedImageData = base64_encode($imageData);
//            $fixedImageSrc = 'data:image/bmp;base64,' . $fixedImageData;
//
//            $fixedImages[] = $fixedImageSrc;
//        }
//
////        echo response()->json(['fixedImages' => $fixedImages]);
////        return response()->json(['fixedImages' => $fixedImages]);
//        return response()->json(['message' => $fixedImages]);

    }
}
