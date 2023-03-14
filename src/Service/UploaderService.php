<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploaderService
{

    // On va lui passer un objet de type UploadedFile
    // Et elle doit nous retourner le nom de cette fichier

    private $targetDirectory;
    private $slugger;

    public function __construct(string $targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function upload(
        UploadedFile $uploadedFile,
    ): string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        dump($this->getTargetDirectory());
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '-' . $uploadedFile->guessExtension();

        try {
            $uploadedFile->move(

                $this->getTargetDirectory(), $newFilename);
        } catch (FileException $e) {
            dump($e);
            die();
            // ... handle exception if something happens during file upload
        }
        return $newFilename;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}