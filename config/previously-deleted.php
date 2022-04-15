<?php

return [
    /*
     * Table to use for deleted attributes.
     *
     * Default: previously_deleted_attributes
     */
    'table' => \Support\Enums\TableName::SUPPORT_PREVIOUSLY_DELETED_ATTRIBUTES,

    /*
     * Failed validation rule message.
     *
     * Default: The given :attribute is not allowed.
     */
    'failed_message' => 'The given :attribute is not allowed.',

    /*
     * Only store deleted attributes if the model uses soft-deletes
     * and has been force-deleted.
     *
     * Default: true
     */
    'ignore_soft_deleted' => true,
];
