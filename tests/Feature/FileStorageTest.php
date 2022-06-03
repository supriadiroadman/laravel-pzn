<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $fileSystem = Storage::disk("local");
        $fileSystem->put("filelocal.txt", "Supriadi Roadman");

        $content = $fileSystem->get("filelocal.txt");

        self::assertEquals("Supriadi Roadman", $content);
    }

    public function testPublic()
    {
        $fileSystem = Storage::disk("public");
        $fileSystem->put("filepublic.txt", "Supriadi Roadman");

        $content = $fileSystem->get("filepublic.txt");

        self::assertEquals("Supriadi Roadman", $content);
    }

}
