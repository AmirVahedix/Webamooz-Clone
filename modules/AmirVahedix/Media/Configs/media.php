<?php

return [
    "types" => [
        "image" => [
            "extensions" => ["png", "jpg", "jpeg"],
            "handler" => \AmirVahedix\Media\Services\ImageFileService::class,
        ],
        "video" => [
            "extensions" => ["avi", "mkv", "mp4"],
            "handler" => \AmirVahedix\Media\Services\VideoFileService::class
        ],
        "zip" => [
            "extensions" => ["zip", "rar", "tar"],
            "handler" => \AmirVahedix\Media\Services\ZipFileService::class
        ]
    ]
];
