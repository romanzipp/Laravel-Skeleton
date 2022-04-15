<?php

namespace Support\Enums;

class TableName extends AbstractEnum
{
    public const SUPPORT_JOBS = 'support__jobs';
    public const SUPPORT_FAILED_JOBS = 'support__failed_jobs';
    public const SUPPORT_MEDIA = 'support__media';
    public const SUPPORT_QUEUE_MONITOR = 'support__queue_monitor';
    public const SUPPORT_PREVIOUSLY_DELETED_ATTRIBUTES = 'support__previously_deleted_attributes';

    public const OAUTH_AUTH_CODES = 'oauth__auth_codes';
    public const OAUTH_ACCESS_TOKENS = 'oauth__access_tokens';
    public const OAUTH_REFRESH_TOKENS = 'oauth__refresh_tokens';
    public const OAUTH_CLIENTS = 'oauth__clients';
    public const OAUTH_PERSONAL_ACCESS_CLIENTS = 'oauth__personal_access_clients';

    public const USER_USERS = 'user__users';
    public const USER_PASSWORD_RESETS = 'user__password_resets';

    public const BLOG_POSTS = 'blog__posts';
    public const BLOG_POST_LOCALIZED_CONTENTS = 'blog__posts_localized_contents';
    public const BLOG_CATEGORIES = 'blog__categories';
    public const BLOG_POST_CATEGORIES = 'blog__post_categories';
}
