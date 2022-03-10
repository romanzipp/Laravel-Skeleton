# Laravel Nova

We include a ready-to-go installation of [Laravel Nova](https://nova.laravel.com). Please see the [installation docs](https://nova.laravel.com/docs/3.0/installation.html) for more information on how to authenticate with your license.

## Resources

- All resources must extend the custom [AbstractNovaResource](/app/App/Nova/Resources/AbstractNovaResource.php) class.
- All resources must be prefixed with `Nova` (`User` model Nova resource: `NovaUser`). This will help when navigating with Go-to-class IDE tools.
- New resources must be created in the according Domain.
  - Add the new Domain to the `resources` method of the [NovaServiceProvider](/app/App/Providers/NovaServiceProvider.php)

See the [User Domain](/app/Domain/User/Nova) for a working example.

## Actions

- All actions must extend the custom [AbstractNovaAction](/app/App/Nova/Actions/AbstractNovaAction.php) class.

## Fields

We ship a custom [EnumSelect]() field which is fully compatible with built in [Enums](enums.md).
