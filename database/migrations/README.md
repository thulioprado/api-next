# Migrations

## Review guidelines

Migrations are IMMUTABLE. This means that once a migration gets merged into master and released, we should NEVER change it's behavior, directly or indirectly.

So, as an overall checklist:

- Is there a logic change to a migration? Close it.
- Is there any kind of reference to the framework besides `Directus\Database\Traits\Migrations\*`? Close it.

### What you mean by indirectly?

You can change the behavior of a migration by accident if you use constants from the framework itself. So for example using `DataType::TYPE_INTEGER` that had it's "initial" value set to `integer`, if for some reason in the future that value changes to `int`, it might cause problems with migrations running on newer installations (for example when there's a check for that value to make a change).
