<?php

namespace Support\Vendor\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Support\Enums\TableName;

class Media extends BaseMedia
{
    protected $table = TableName::SUPPORT_MEDIA;
}
