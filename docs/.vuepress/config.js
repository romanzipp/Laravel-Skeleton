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
                    '/documentation/nova.md',
                    '/documentation/actions.md',
                    '/documentation/data.md',
                    '/documentation/enums.md',
                    '/documentation/events.md',
                    '/documentation/models.md',
                    '/documentation/repositories.md',
                    '/documentation/resources.md',
                    '/documentation/table-names.md',
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
