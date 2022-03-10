module.exports = {
    base: '/Laravel-Skeleton/',
    title: 'Laravel Skeleton',
    description: 'Domain Driven Laravel Skeleton with strong type hinting',
    host: '0.0.0.0',
    port: 3001,
    themeConfig: {
        nav: [
            { text: 'Home', link: '/' },
            { text: 'GitHub', link: 'https://github.com/romanzipp/Laravel-Skeleton' },
        ],
        sidebar: [
            '/',
            {
                title: 'Laravel',
                collapsable: false,
                children: [
                    'laravel/nova.md',
                    'laravel/blog.md',
                    'laravel/actions.md',
                    'laravel/data.md',
                    'laravel/enums.md',
                    'laravel/events.md',
                    'laravel/models.md',
                    'laravel/repositories.md',
                    'laravel/resources.md',
                    'laravel/table-names.md',
                ]
            },
            {
                title: 'Frontend',
                children: [
                    'frontend/frontend.md'
                ]
            },
            {
                title: 'Deployment',
                children: [
                    'deploy/deploy.md'
                ]
            }
        ],
        sidebarDepth: 2
    }
};
