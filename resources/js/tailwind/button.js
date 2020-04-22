module.exports = function ({ addComponents, theme }) {

    const buttons = {
        '.button': {
            display: 'inline-flex',
            flex: theme('flex.initial'),
            justifyContent: 'center',
            alignItems: 'center',
            padding: `${theme('padding.2')} ${theme('padding.4')}`,
            borderRadius: theme('borderRadius.default'),
            fontSize: theme('fontSize.sm'),
            fontWeight: theme('fontWeight.medium'),
            textAlign: 'center',
            userSelect: 'none',
            '&.button-sm': {
                padding: `${theme('padding.1')} ${theme('padding.3')}`,
                fontSize: theme('fontSize.xs')
            },
            '&.button-lg': {
                padding: `${theme('padding.3')} ${theme('padding.8')}`,
                fontSize: theme('fontSize.base')
            },
            '&[disabled]': {
                opacity: .625,
                cursor: theme('cursor.not-allowed')
            },
            'ion-icon:not(.ignore)': {
                marginLeft: theme('margin.2')
            }
        }
    };

    for (let color of Object.keys(theme('colors'))) {

        if (typeof theme(`colors.${color}.500`) === 'undefined') {
            continue;
        }

        buttons[`.button-${color}`] = {
            backgroundColor: theme(`colors.${color}.600`),
            color: theme(`colors.${color}.100`),
            '&:hover:not([disabled])': {
                backgroundColor: theme(`colors.${color}.700`)
            },
            '&.button-secondary': {
                backgroundColor: theme(`colors.${color}.200`),
                color: theme(`colors.${color}.800`),
                '&:hover:not([disabled])': {
                    backgroundColor: theme(`colors.${color}.300`)
                }
            }
        };
    }

    buttons['.button-white'] = {
        backgroundColor: theme('colors.white'),
        color: theme('colors.gray.800'),
        '&:hover:not([disabled])': {
            backgroundColor: theme('colors.gray.100')
        },
        '&.button-secondary': {
            backgroundColor: theme('colors.gray.200'),
            color: theme('colors.gray.800'),
            '&:hover:not([disabled])': {
                backgroundColor: theme('colors.gray.300')
            }
        }
    };

    addComponents(buttons);
};
