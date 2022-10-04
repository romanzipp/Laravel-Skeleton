module.exports = {
    base: '/Laravel-Skeleton/',
    title: 'Laravel Skeleton',
    description: 'Domain Driven Laravel Skeleton with strong type hinting',
    host: 'localhost',
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
                    'laravel/blog.md',
                    'laravel/actions.md',
                    'laravel/data.md',
                    'laravel/enums.md',
                    'laravel/events.md',
                    'laravel/models.md',
                    'laravel/nova.md',
                    'laravel/oauth.md',
                    'laravel/repositories.md',
                    'laravel/resources.md',
                    'laravel/table-names.md',
                ]
            },
            {
                title: 'Frontend',
                collapsable: false,
                children: [
                    'frontend/frontend.md'
                ]
            },
            {
                title: 'Deployment',
                collapsable: false,
                children: [
                    'deploy/docker.md',
                    'deploy/deploy.md'
                ]
            }
        ],
        sidebarDepth: 2
    }
};
