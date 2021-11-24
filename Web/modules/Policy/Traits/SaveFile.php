<?php

namespace Modules\Policy\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait SaveFile
{
    /**
     * @param UploadedFile $file
     * @param $fillable
     * @param $destinationDir
     * @return bool
     */
    public  function saveFile(UploadedFile $file, $fillable, $destinationDir): bool
    {
        $fileName = $file->getClientOriginalName();
        $fileName = str_replace(' ', '-', $fileName);

        if (Storage::disk('public')->exists($destinationDir.$fileName)) {
            $fileName = now()->timestamp . '_' . $fileName;
        }

        Storage::disk('public')->putFileAs($destinationDir, $file, $fileName);

        return $this->update([
            "$fillable" => $destinationDir . $fileName,
        ]);
    }
}
