module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: [
        'airbnb-base',
    ],
    parserOptions: {
        parser: 'babel-eslint',
        sourceType: 'module',
        ecmaVersion: 12,
    },
    rules: {
        indent: ['error', 4],
        'max-len': 'off',
        'no-continue': 'off',
        'no-restricted-syntax': 'off',
        'import/no-unresolved': 'off',
        'import/no-extraneous-dependencies': 'off',
    },
    settings: {
        'import/resolver': 'webpack',
    },
    globals: {
        process: true,
    },
};
