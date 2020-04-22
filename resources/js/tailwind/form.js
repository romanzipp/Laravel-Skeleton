module.exports = function ({ theme, addComponents }) {
    addComponents({
        '.input': {
            backgroundColor: theme('colors.gray.200'),
            padding: `${theme('margin.1')} ${theme('margin.2')}`,
            borderRadius: theme('borderRadius.sm'),
            fontSize: theme('fontSize.sm'),
            color: theme('colors.gray.800'),
            border: `3px solid ${theme('colors.gray.200')}`,
            outline: 'none',
            '&:focus': {
                borderColor: theme('colors.blue.300')
            },
            '&::placeholder': {
                color: theme('colors.gray.500')
            },
            '&.input-error': {
                backgroundColor: theme('colors.red.100'),
                color: theme('colors.red.800'),
                borderColor: theme('colors.red.200'),
                '&::placeholder': {
                    color: theme('colors.red.300')
                }
            }
        },
        'form': {
            '.field': {
                'label': {
                    display: 'block',
                    fontSize: theme('fontSize.xs'),
                    color: theme('colors.gray.700'),
                    marginBottom: theme('margin.2')
                },
                '&.checkbox-field': {
                    display: 'flex',
                    alignItems: 'center',
                    'label': {
                        marginBottom: 0,
                        paddingLeft: theme('padding.2'),
                        fontSize: theme('fontSize.sm')
                    },
                    'label, input[type="checkbox"]': {
                        cursor: 'pointer'
                    }
                }
            }
        }
    });
};
