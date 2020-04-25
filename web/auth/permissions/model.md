#Permissions and Authorization
----

Django comes with a simple permissions system. It provides a way to assign permissions to specific users and groups of users.

It’s used by the Django admin site, but you’re welcome to use it in your own code.

The Django admin site uses permissions as follows:

 - Access to view objects is limited to users with the “view” or “change” permission for that type of object.
 - Access to view the “add” form and add an object is limited to users with the “add” permission for that type of object.
 - Access to view the change list, view the “change” form and change an object is limited to users with the “change” permission for that type of object.
 - Access to delete an object is limited to users with the “delete” permission for that type of object.
 - Permissions can be set not only per type of object, but also per specific object instance. By using the has_view_permission(), has_add_permission(), has_change_permission() and has_delete_permission() methods provided by the ModelAdmin class, it is possible to customize permissions for different object instances of the same type.

User objects have two many-to-many fields: groups and user_permissions. User objects can access their related objects in the same way as any other Django model:



myuser.groups.set([group_list])
myuser.groups.add(group, group, ...)
myuser.groups.remove(group, group, ...)
myuser.groups.clear()
myuser.user_permissions.set([permission_list])
myuser.user_permissions.add(permission, permission, ...)
myuser.user_permissions.remove(permission, permission, ...)
myuser.user_permissions.clear()


Assuming you have an application with an app_label foo and a model named Bar, to test for basic permissions you should use:

 - add: user.has_perm('foo.add_bar')
 - change: user.has_perm('foo.change_bar')
 - delete: user.has_perm('foo.delete_bar')
 - view: user.has_perm('foo.view_bar')