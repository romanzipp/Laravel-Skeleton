<?php

namespace Support\Vendor\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Support\Enums\TableName;

/**
 * @property int $id
 * @property string $model_type
 * @property string $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property array $manipulations
 * @property array $custom_properties
 * @property array $generated_conversions
 * @property array $responsive_images
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Support\Models\AbstractModel|null $model
 * @property int|null $models_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Support\Vendor\MediaLibrary\Media ordered()
 */
class Media extends BaseMedia
{
    protected $table = TableName::SUPPORT_MEDIA;
}
