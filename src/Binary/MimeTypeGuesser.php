<?php
namespace HtImgModule\Binary;

use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesserInterface as SymfonyMimeTypeGuesserInterface;

class MimeTypeGuesser
{
    /**
     * @var SymfonyMimeTypeGuesserInterface
     */
    protected $mimeTypeGuesser;

    /**
     * @param SymfonyMimeTypeGuesserInterface $mimeTypeGuesser
     */
    public function __construct(SymfonyMimeTypeGuesserInterface $mimeTypeGuesser)
    {
        $this->mimeTypeGuesser = $mimeTypeGuesser;
    }

    /**
     * Gets mime type of binary
     *
     * @param  string     $binary
     * @return string
     * @throws \Exception
     */
    public function guess($binary)
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'ht-img-module');

        try {
            file_put_contents($tmpFile, $binary);

            $mimeType = $this->mimeTypeGuesser->guess($tmpFile);

            unlink($tmpFile);

            return $mimeType;
        } catch (\Exception $e) {
            unlink($tmpFile);

            throw $e;
        }
    }
}
