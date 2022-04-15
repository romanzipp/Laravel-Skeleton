<?php

namespace Support\Enums;

class TableName extends AbstractEnum
{
    public const SUPPORT_JOBS = 'support-jobs';
    public const SUPPORT_FAILED_JOBS = 'support-failed_jobs';
    public const SUPPORT_MEDIA = 'support-media';
    public const SUPPORT_QUEUE_MONITOR = 'support-queue_monitor';
    public const SUPPORT_PREVIOUSLY_DELETED_ATTRIBUTES = 'support-previously_deleted_attributes';

    public const OAUTH_AUTH_CODES = 'oauth__auth_codes';
    public const OAUTH_ACCESS_TOKENS = 'oauth__access_tokens';
    public const OAUTH_REFRESH_TOKENS = 'oauth__refresh_tokens';
    public const OAUTH_CLIENTS = 'oauth__clients';
    public const OAUTH_PERSONAL_ACCESS_CLIENTS = 'oauth__personal_access_clients';

    public const USER_USERS = 'user-users';
    public const USER_PASSWORD_RESETS = 'user-password_resets';

    public const BLOG_POSTS = 'blog-posts';
    public const BLOG_POST_LOCALIZED_CONTENTS = 'blog-posts_localized_contents';
    public const BLOG_CATEGORIES = 'blog-categories';
    public const BLOG_POST_CATEGORIES = 'blog-post_categories';
}
