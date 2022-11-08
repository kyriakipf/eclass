<?php

namespace App\SupportClasses;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class FileUploader
{
    /**
     * FileSaveLocation::SAVE_LOCATION['PUBLIC'] \public
     * FileSaveLocation::SAVE_LOCATION['INTERNAL_STORAGE'] i.e. \storage\app
     * FileSaveLocation::SAVE_LOCATION['INTERNAL_STORAGE_PUBLIC'] i.e. \storage\app\public
     */
    const SAVE_LOCATION = ['PUBLIC' => 1, 'INTERNAL_STORAGE' => 2, 'INTERNAL_STORAGE_PUBLIC' => 3];

    protected $save_location;
    protected $auto_rename;

    /**
     * @param int $saveLocationFlag usage-> FileUploader::SAVE_LOCATION['PUBLIC'] for saving to \public
     * FileUploader::SAVE_LOCATION['INTERNAL_STORAGE'] i.e. \storage\app (this is the DEFAULT used!)
     * FileUploader::SAVE_LOCATION['INTERNAL_STORAGE_PUBLIC'] i.e. \storage\app\public
     * @param bool $autoRename Default set to false. Use it if you wish files to be renamed automatically to avoid over writing.
     * If set to true it will add a time stamp at the beginning of the filename
     */
    public function __construct(int $saveLocationFlag = FileSaveLocation::INTERNAL_STORAGE, bool $autoRename = false)
    {
        $this->save_location = $saveLocationFlag;
        $this->auto_rename = $autoRename;
    }

    /**
     * Saves the UploadedFile passed in,to the specified location. If the final directory does not exist it will create it.
     * @param UploadedFile|null $file the file to be uploaded as read by $request->file('file_input_field_name')
     * @param string $extraPath Determine the extra path to be added after the save_location specified at the constructor
     * and before the filename. Do not need to add leading and trailing slashes (i.e. directory1\directory2). Also note that
     * slug() will be performed on this parameter.
     * @param string $newFilename Specify a new file name for the uploaded file, leave empty to use the original or auto rename, depending on the
     * constructor parameters
     * @param bool $emptyFinalDirectory If set to true it will empty the final location directory (default set to false)
     * @param bool $sanitizeFilename Default set to true
     * @return array ['filename', 'filepath', 'relativePath']
     * @throws \Exception
     */
    public function Save(?UploadedFile $file, string $extraPath, string $newFilename = '', bool $emptyFinalDirectory = false, bool $sanitizeFilename = true) : array
    {
        if(!$file)
        {
            return ['filename' => '', 'filepath' => '', 'relativePath' => ''];
        }

        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        // decide the final filename that file will be uploaded by, based on the parameters specified
        $filename = $this->getFinalFilename($newFilename, $filename, $sanitizeFilename, $extension);

        // check the location selected and call the respective method
        switch ($this->save_location)
        {
            case self::SAVE_LOCATION['PUBLIC']:
                return $this->savePublic($file, $extraPath, $filename, $emptyFinalDirectory);
            case self::SAVE_LOCATION['INTERNAL_STORAGE']: // \storage\app
                return $this->saveToStorage($file, $this->getAbsPathToStorageFolder($extraPath),
                    $extraPath . DIRECTORY_SEPARATOR, $filename, $emptyFinalDirectory);
            case self::SAVE_LOCATION['INTERNAL_STORAGE_PUBLIC']: // \storage\app\public
                return $this->saveToStorage($file, $this->getAbsPathToStoragePublicFolder($extraPath),
                    DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $extraPath . DIRECTORY_SEPARATOR, $filename, $emptyFinalDirectory);
            case self::SAVE_LOCATION['CLOUD']:
                return ['filename' => '', 'filepath' => '', 'relativePath' => ''];
            default:
                throw new \Exception('FileUploader -> unrecognised save location!');
        }
    }


    /**
     * @param UploadedFile|null $file
     * @param string $extraPath
     * @param bool $emptyFinalDirectory
     * @param string $filename
     * @return array
     */
    protected function savePublic(UploadedFile $file, string $extraPath, string $filename, bool $emptyFinalDirectory): array
    {
        throw new \Exception('FileUploader -> Method not Implemented');
    }


    /**
     * @param UploadedFile|null $file
     * @param string $absolutePathToFolder
     * @param string $relativePathToFolder
     * @param bool $emptyFinalDirectory
     * @param string $filename
     * @return array
     */
    protected function saveToStorage(UploadedFile $file, string $absolutePathToFolder, string $relativePathToFolder, string $filename, bool $emptyFinalDirectory): array
    {
        // create directory if does not exist!
        File::ensureDirectoryExists($absolutePathToFolder);

        if ($emptyFinalDirectory) {
            // clean directory (pass in relative path)
            // Storage::path reaches ...\storage\app folder
            File::cleanDirectory(Storage::path($relativePathToFolder));
        }

        // store file
        $file->storeAs($relativePathToFolder, $filename);

        return ['filename' => $filename, 'filepath' => $absolutePathToFolder, 'relativePath' => $relativePathToFolder];
    }


    /***    HELPER METHODS  ***/

    /**
     * Sanitizes file name (removes possible duplicate extension and replaces
     * illegal characters with underscore)
     */
    protected function sanitizeFilename(string $filename, string $extension): string
    {
        $name_adjusted = Str::replaceLast('.' . $extension, '', $filename);
        $name_final = Str::slug($name_adjusted, '_');
        return $name_final . '.' . $extension;
    }


    /**
     * // Returns the absolute path to C:\xampp\htdocs\open-calls\storage\$extraPath
     */
    protected function getAbsPathToStorageFolder(string $extraPath)
    {
        // storage_path() returns absolute path to C:\xampp\htdocs\open-calls\storage
        return storage_path('app') . DIRECTORY_SEPARATOR . $extraPath;
    }

    /**
     * // Returns the absolute path to C:\xampp\htdocs\open-calls\storage\public\$extraPath
     */
    protected function getAbsPathToStoragePublicFolder(string $extraPath)
    {
        return storage_path('app' . DIRECTORY_SEPARATOR . 'public') . DIRECTORY_SEPARATOR . $extraPath;
    }


    /**
     * @param string $newFilename
     * @param string $filename
     * @param bool $sanitizeFilename
     * @param string $extension
     * @return string
     */
    public function getFinalFilename(string $newFilename, string $filename, bool $sanitizeFilename, string $extension): string
    {
        if (!empty($newFilename))
        {
            $filename = $newFilename;
        }

        if ($sanitizeFilename)
        {
            $filename = $this->sanitizeFilename($filename, $extension);
        }

        if ($this->auto_rename)
        {
            $filename = date('Ymd') . '_' . date('hms') . $filename;
        }

        return $filename;
    }
}
