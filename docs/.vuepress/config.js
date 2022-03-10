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
                    '/documentation/actions.md',
                    '/documentation/data.md',
                    '/documentation/enums.md',
                    '/documentation/models.md',
                    '/documentation/repositories.md',
                    '/documentation/resources.md',
                    '/documentation/table-names.md',
                    '/documentation/events.md',
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
        displayAllHeaders: true,
        sidebarDepth: 2
    }
};
