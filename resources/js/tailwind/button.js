const Color = require('color');
const plugin = require('tailwindcss/plugin');

module.exports = plugin(function ({ addComponents, theme }) {

    const buttons = {
        '.button': {
            display: 'inline-flex',
            flex: theme('flex.initial'),
            justifyContent: 'center',
            alignItems: 'center',
            padding: `${theme('padding.3')} ${theme('padding.6')}`,
            borderRadius: theme('borderRadius.default'),
            fontSize: theme('fontSize.sm'),
            fontWeight: theme('fontWeight.medium'),
            textAlign: 'center',
            userSelect: 'none',
            cursor: 'pointer',
            '&.button-sm': {
                padding: `${theme('padding.1')} ${theme('padding.3')}`,
                fontSize: theme('fontSize.xs')
            },
            '&.button-lg': {
                padding: `${theme('padding.4')} ${theme('padding.12')}`,
                fontSize: theme('fontSize.base')
            },
            '&[disabled]': {
                opacity: .625,
                cursor: theme('cursor.not-allowed')
            },
            'ion-icon:not(.ignore)': {
                '&.left': {
                    marginRight: theme('margin.3')
                },
                '&:not(.left)': {
                    marginLeft: theme('margin.3')
                }
            }
        }
    };

    for (let color of Object.keys(theme('colors'))) {

        if (typeof theme(`colors.${color}.500`) === 'undefined') {
            continue;
        }

        const baseColor = color === 'gray' ? 600 : 500;

        buttons[`.button-${color}`] = {

            backgroundColor: theme(`colors.${color}.${baseColor}`),
            color: theme(`colors.${color}.${baseColor - 400}`),
            transition: 'background-color .15s, box-shadow .15s, border .15s',

            boxShadow: `
                0 0.1px 0.5px ${Color(theme(`colors.${color}.500`)).alpha(0.081).hsl()},
                0 0.4px 1.6px ${Color(theme(`colors.${color}.500`)).alpha(0.119).hsl()},
                0 2px 7px ${Color(theme(`colors.${color}.500`)).alpha(0.2).hsl()}
            `,

            '&:hover:not([disabled])': {
                backgroundColor: theme(`colors.${color}.${baseColor + 100}`),
            },

            '&.button-secondary': {

                backgroundColor: theme(`colors.${color}.200`),
                color: theme(`colors.${color}.800`),

                '&:hover:not([disabled])': {
                    backgroundColor: theme(`colors.${color}.300`),
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
});
