# Admin Console

Using Admin console, Super admin can able to create, suspend and resume Instance of Tenent/Organisation. Only Super admin can able to access Tenant. Tenant menu will be shown to Super admin when user logged in to the console

# Installation

* Create a database and update the .env file. If no .env file found, get it from fresh installation of laravel and update.
* Run "php artisan migrate:refresh --seed" from command line. This command will create tables and needed table entries

## Notes:

* Do not modify/remove table with prefix "saas"
* If you found any issue or have any doubt, contact Admin/Manager

## Super admin credentials:

Username - info@smackcoders.com
Password - smack5403

## Roles and Permission

You can do stuff like this:

```php
//adding permissions to a user
$user->givePermissionTo('edit articles');

//adding permissions via a role
$user->assignRole('writer');
$user2->assignRole('writer');

$role->givePermissionTo('edit articles');
```

You can test if a user has a permission with Laravel's default `can`-function.
```php
$user->can('edit articles');
```
This package allows for users to be associated with roles. Permissions can be associated with roles.
A `Role` and a `Permission` are regular Eloquent-models. They can have a name and can be created like this:

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

$role = Role::create(['name' => 'writer']);
$permission = Permission::create(['name' => 'edit articles']);
```

The `HasRoles` adds eloquent relationships to your models, which can be accessed directly or used as a base query.

```php
$permissions = $user->permissions;
$roles = $user->roles()->pluck('name'); // returns a collection
```

The `HasRoles` also adds a scope to your models to scope the query to certain roles.

```php
$users = User::role('writer')->get(); // Only returns users with the role 'writer'
```

### Using permissions
A permission can be given to a user:

```php
$user->givePermissionTo('edit articles');

//you can also give multiple permission at once
$user->givePermissionTo('edit articles', 'delete articles');

//you may also pass an array
$user->givePermissionTo(['edit articles', 'delete articles']);
```

A permission can be revoked from a user:

```php
$user->revokePermissionTo('edit articles');
```

You can test if a user has a permission:
```php
$user->hasPermissionTo('edit articles');
```

Saved permissions will be registered with the `Illuminate\Auth\Access\Gate`-class. So you can
test if a user has a permission with Laravel's default `can`-function.
```php
$user->can('edit articles');
```

### Using roles and permissions
A role can be assigned to a user:

```php
$user->assignRole('writer');

// you can also assign multiple roles at once
$user->assignRole('writer', 'admin');
$user->assignRole(['writer', 'admin']);
```

A role can be removed from a user:

```php
$user->removeRole('writer');
```

Roles can also be synced :

```php
//all current roles will be removed from the user and replace by the array given
$user->syncRoles(['writer', 'admin']);
```

You can determine if a user has a certain role:

```php
$user->hasRole('writer');
```

You can also determine if a user has any of a given list of roles:
```php
$user->hasAnyRole(Role::all());
```
You can also determine if a user has all of a given list of roles:

```php
$user->hasAllRoles(Role::all());
```

The `assignRole`, `hasRole`, `hasAnyRole`, `hasAllRoles`  and `removeRole`-functions can accept a
 string, a `Spatie\Permission\Models\Role`-object or an `\Illuminate\Support\Collection`-object.

 A permission can be given to a role:

 ```php
 $role->givePermissionTo('edit articles');
 ```


 You can determine if a role has a certain permission:

 ```php
 $role->hasPermissionTo('edit articles');
 ```

 A permission can be revoked from a role:

 ```php
 $role->revokePermissionTo('edit articles');
 ```

 The `givePermissionTo` and `revokePermissionTo`-functions can accept a 
 string or a `Spatie\Permission\Models\Permission`-object.

 Saved permission and roles are also registered with the `Illuminate\Auth\Access\Gate`-class.
 ```php
 $user->can('edit articles');
 ```

 ### Using blade directives
 This package also adds Blade directives to verify whether the
 currently logged in user has all or any of a given list of roles.

 ```php
 @role('writer')
 I'm a writer!
 @else
 I'm not a writer...
 @endrole
 ```

 ```php
 @hasrole('writer')
 I'm a writer!
 @else
 I'm not a writer...
 @endhasrole
 ```

 ```php
 @hasanyrole(Role::all())
 I have one or more of these roles!
 @else
 I have none of these roles...
 @endhasanyrole
 ```

 ```php
 @hasallroles(Role::all())
 I have all of these roles!
 @else
 I don't have all of these roles...
 @endhasallroles
 ```

 You can use Laravel's native `@can` directive to check if a user has a certain permission.

For more information about Roles and Permission, refer https://github.com/spatie/laravel-permission

### Fake Seeding

Run below command to create fake Users, Organisation, Roles and Permission.

php artisan db:seed --class=FakerSeeder

You can also use the faker to seed your model.

For more information about Faker refer https://github.com/fzaninotto/Faker
