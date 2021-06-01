<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading;


use Astaroth\VkUtils\Uploading\Methods\PhotoSaveMessages;
use Astaroth\VkUtils\Uploading\Objects\Abstract\AbstractDoc;
use Astaroth\VkUtils\Uploading\Objects\Photo;
use Closure;

final class MessagesUploader extends AbstractUploader
{

    protected function uploadDocCompatibility(): Closure
    {
        return function (AbstractDoc $DocInstances) {
            $data = $this->getMessagesUploadServer($DocInstances->getPeerId(), $DocInstances->getFileType());
            $response = $this->uploadFile
            (
                $data['response']['upload_url'],
                $DocInstances->getPath(),
                'file'
            );

            $DocInstances->setFile($response['file']);
            return $this->docsSave($DocInstances);
        };
    }

    protected function uploadPhoto(): Closure
    {
        return function (Photo $PhotoInstances) {
            $data = $this->getMessagesUploadServer($PhotoInstances->getGroupId(), $PhotoInstances->getFileType());
            $response = $this->uploadFile
            (
                $data['response']['upload_url'],
                $PhotoInstances->getPath(),
                'file'
            );
            return $this->photoSave(new PhotoSaveMessages($response));
        };
    }
}