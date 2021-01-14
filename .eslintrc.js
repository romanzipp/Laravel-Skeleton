module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: [
        'airbnb-base',
        'plugin:vue/essential',
        'plugin:vue/strongly-recommended',
    ],
    parserOptions: {
        parser: 'babel-eslint',
        sourceType: 'module',
        ecmaVersion: 12,
    },
    plugins: [
        'vue',
    ],
    rules: {
        indent: ['error', 4],
        'max-len': 'off',
        'import/no-unresolved': 'off',
        'no-restricted-syntax': 'off',
        'vue/html-indent': ['error', 4],
        'vue/html-closing-bracket-newline': ['error', {
            singleline: 'never',
            multiline: 'never',
        }],
        'vue/multiline-html-element-content-newline': ['error', {
            allowEmptyLines: true,
        }],
        'vue/max-attributes-per-line': ['error', {
            multiline: {
                allowFirstLine: true,
            },
        }],
    },
    settings: {
        'import/resolver': 'webpack',
    },
    globals: {
        process: true,
    },
};
