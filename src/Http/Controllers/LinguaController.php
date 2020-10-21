<?php

namespace alessandrobelli\Lingua\Http\Controllers;

use \ZipArchive;
use alessandrobelli\Lingua\LinguaUtilities;
use alessandrobelli\Lingua\Translation;
use Illuminate\Support\Facades\File;

class LinguaController
{
    public function index()
    {
        return view('lingua::lingua');
    }

    public function create()
    {
        return view('lingua::import');
    }

    public function conflicts()
    {
        return view('lingua::conflicts');

    }

    public function download()
    {
        $translations = Translation::all();
        $filename = request()->language . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Text', 'Language', 'Project', 'Translation']);
        foreach ($translations as $translation) {
            $row['Text'] = $translation->string;
            $row['Language'] = LinguaUtilities::array_multidimensional_search(config('lingua.locales-list'), 'locale', request()->language)[0]['isolanguagename'];
            $row['Project'] = $translation->project;
            $row['Translation'] = $translation->locales[request()->language];
            fputcsv($handle, [$row['Text'], $row['Language'], $row['Project'], $row['Translation']]);
        }
        fclose($handle);
        $headers = [
            'Content-Type: text/csv',
            'charset: utf-8',
        ];

        return response()->download($filename, $filename, $headers);
    }

    public function downloadJsons()
    {
        $files = File::files(resource_path() . "/lang/");

        $public_dir = public_path() . DIRECTORY_SEPARATOR;
        $zipname = 'translations.zip';
        $zip = new ZipArchive;

        if ($zip->open($public_dir . DIRECTORY_SEPARATOR . $zipname, \ZipArchive::CREATE)) {
            foreach ($files as $file) {
                $zip->addFile($file->getRealPath(), $file->getBasename());
            }

            $zip->close();
        } else {
            echo 'Could not open ZIP file.';
        }
        // Set Header
        $headers = [
            'Content-Type' => 'application/octet-stream',
        ];
        $filetopath = $public_dir . '/' . $zipname;
        if (file_exists($filetopath)) {
            return response()->download($filetopath, $zipname, $headers);
        } else {
            echo "error";
        }
    }
}
