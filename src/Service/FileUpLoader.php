<?php


namespace App\Service;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//Class qui permet de gerer l'upload
class FileUpLoader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {

       // $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $fileName =$file->getClientOriginalName();

            $file->move($this->getTargetDirectory(), $fileName);


        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}