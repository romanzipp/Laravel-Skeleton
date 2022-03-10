# Blog

We also ship various tools for a basic Blog.

## Remove Blog component

If you don't need any of these components, feel free to remove the following directories

- [app/Domain/Blog](/app/Domain/Blog)
- [database/factories/Blog](/database/factories/Blog)
- [resources/vies/app/pages/blog](/resources/vies/app/pages/blog)

... and the following files ...

- [database/migrations/2022_03_08_111314_create_blog-posts_table.php](/database/migrations/2022_03_08_111314_create_blog-posts_table.php)
- [database/migrations/2022_03_08_111441_create_blog-categories_table.php](/database/migrations/2022_03_08_111441_create_blog-categories_table.php)
- [database/migrations/2022_03_08_111523_create_blog-post_categories_table.php](/database/migrations/2022_03_08_111523_create_blog-post_categories_table.php)
- [database/migrations/2022_03_08_111548_create_blog-post_localized_content_table.php](/database/migrations/2022_03_08_111548_create_blog-post_localized_content_table.php)
- [database/seeders/BlogSeeder.php](/database/seeders/BlogSeeder.php)

Further, remove any references to the Blogs in ...

- [app/App/Providers/NovaServiceProvider.php](/app/App/Providers/NovaServiceProvider.php)
- [app/Support/Enums/TableName.php](/app/Support/Enums/TableName.php)
- [database/seeders/DatabaseSeeder.php](/database/seeders/DatabaseSeeder.php)
- [routes/web.php](/routes/web.php)
- [config/filesystems.php](/config/filesystems.php)
