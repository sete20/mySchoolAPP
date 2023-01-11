<?php

use App\Jobs\UploadAttachmentsAndVideosJob;

if (!function_exists('upload_files')) {
    function upload_files($video, $attachments = null, $model)
    {
        $model->addMedia($video)->toMediaCollection('video');
        if ($attachments != null) {
            foreach ($attachments as $attachment) {
                $model->addMedia($attachment)->toMediaCollection('attachments');
            }
        }
    }
}
