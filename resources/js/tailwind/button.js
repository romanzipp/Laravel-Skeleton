const plugin = require('tailwindcss/plugin');

module.exports = plugin(function ({ addComponents, theme }) {
    const buttons = {
        '.button': {
            display: 'inline-flex',
            flex: theme('flex.initial'),
            justifyContent: 'center',
            alignItems: 'center',
            padding: `${theme('padding.2')} ${theme('padding.4')}`,
            borderRadius: theme('borderRadius.default'),
            fontFamily: theme('fontFamily.display'),
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
                padding: `${theme('padding.3')} ${theme('padding.12')}`,
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
            borderWidth: '0px',

            '&:hover': {
                backgroundColor: theme(`colors.${color}.${baseColor + 100}`)
            },

            '&.button-bold': {
                boxShadow: `
                    ${theme(`colors.${color}.${baseColor - 300}`)} 0px 1px 2px 0px,
                    ${theme(`colors.${color}.${baseColor - 100}`)} 0px 1px 0px 0px inset`,
                borderWidth: '1px',
                borderColor: theme(`colors.${color}.${baseColor + 100}`),

                '&:hover': {
                    backgroundColor: theme(`colors.${color}.${baseColor + 100}`),
                    boxShadow: `
                    ${theme(`colors.${color}.${baseColor - 300}`)} 0px 1px 2px 0px,
                    ${theme(`colors.${color}.${baseColor}`)} 0px 1px 0px 0px inset`,
                    borderColor: theme(`colors.${color}.${baseColor + 200}`)
                }
            },

            '&.button-basic': {
                backgroundColor: theme(`colors.${color}.100`),
                color: theme(`colors.${color}.${baseColor + 300}`),

                '&:hover:not([disabled])': {
                    backgroundColor: theme(`colors.${color}.${baseColor - 300}`)
                }
            },

            '&.button-secondary': {

                backgroundColor: theme(`colors.${color}.200`),
                color: theme(`colors.${color}.800`),
                boxShadow: `${theme('colors.gray.300')} 0px 1px 2px 0px`,
                borderWidth: '1px',
                borderColor: theme(`colors.${color}.300`),

                '&:hover': {
                    backgroundColor: theme(`colors.${color}.300`),
                    boxShadow: `${theme('colors.gray.400')} 0px 1px 2px 0px`,
                    borderColor: theme(`colors.${color}.400`)
                }
            }
        };
    }

    addComponents(buttons);
});
