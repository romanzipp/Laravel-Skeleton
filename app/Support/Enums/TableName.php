<?php

namespace Support\Enums;

class TableName extends AbstractEnum
{
    public const SUPPORT_JOBS = 'support-jobs';
    public const SUPPORT_FAILED_JOBS = 'support-failed_jobs';

    public const USER_USERS = 'user-users';
    public const USER_PASSWORD_RESETS = 'user-password_resets';

    public const BLOG_POSTS = 'blog-posts';
    public const BLOG_POST_LOCALIZED_CONTENTS = 'blog-posts_localized_contents';
    public const BLOG_CATEGORIES = 'blog-categories';
    public const BLOG_POST_CATEGORIES = 'blog-post_categories';
}
