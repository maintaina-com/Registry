# The Horde Registry

This package is an experimental PHP8.1+ reinvention of horde/core's Horde_Registry class. It will be different in approach, incompatible in design and existing apps will likely not work with it, at least unmodified. It is much too early to use this for anything serious.

## Mission Statement (Draft)

A horde setup is a highly configurable multi-app plugin system in which the actual apps are not the root items.
This is fundamentally different from most frameworks which center around individual apps and services.

Registry provides the necessary egg to easily create the chicken by separating discovery from bootstrapping.
Registry provides a lean API for dependency managers or setup tools to automatically make the environment run.

### Discovery phase tasks

- Assume an autoloader is already present
- Setup the DI container
- Create a registry implementation by autodetection or explicitly
- Find out which apps, drivers, services, themes etc are installed and their necessary bootstrapping metadata
- Serialize the config egg for runtime phase

### Runtime phase tasks

- Assume an autoloader is already present
- Retrieve the config egg by convention
- Set up the DI container according to config

## Misc Design ideas

- Leave autoloading to a distinct installation process. The goto solution currently is composer. The recent composer version v2.4 provides other runtime utilities. Anything that is not strictly PSR-0 or strictly PSR-4 must be worked around by the consuming application, a provided class map or a loader class. Registry has no stakes in autoloading, it requires it.
- prefer capability meta packages (provides) over package types.
- Be sane about factoring out. Keep necessary bootstrapping parts builtin, factor out what can be loaded/found on demand. Don't recreate the fat H5 horde/core.
- Need some mechanism loosely to tie agnostic drivers like DB, LDAP to a reusable config format and appropriate factories.
- Set up the namespaced version of Horde\Injector as a PSR-11 container.
- The application is responsible for announcing capabilities and integration points in a granular, idiomatic way. Registry works with the PSR-11 container for any real registration and composition business.
- Applications can have individual constructors and can announce a DI container configuration method through an interface.
- Appplications should ensure that they don't crash the wider installation if they are configured incompletely or are in an unviable state.
- A horde base app is no longer strictly required. Applications only care if all their services and dependencies are available.
- Don't be responsible for too many things. Find a mission statement that is sufficient but not bigger than necessary.
- The registry should use a driver/plugin system for the very basic initialization tasks like finding out which supported applications are installed (think composer), where stuff can be found etc.
- The registry come with some basic capability and handling options but should have few dependencies. Factor out advanced stuff into separate packages.
- A default installation should require zero configuration to show something viable in the browser.
- "global" or "default" driver configurations for sub systems such as SQL, Cache, Logging should live in a separate config area. The base horde app, if it is present, can be used to configure them through a UI. 

## Responsibilities
- Provide runtime knowledge about buildtime facts like installed apps, available APIs, themes, commands...
- Generally the registry maintains iterables in its DI container.
- The DI container should not spill into apps level too much outside well-defined integration points. It should rather setup the app with the necessary adapters, proxies, managers, services which allow the app to consume its more specific resources in a more idiomatic way.
- If multiple apps implement some api, provide a default no-config conflict resolution and means to override it.
- Provide a workflow and environments for apps to bootstrap themselves.
- Provide methods to broadcast messages/events to all apps which are interested.
- Provide a common means to call into a specific app's APIs and resources. Provide introspection.

## Non-Responsibilities
- Registry should be blissfully unaware of databases, imap servers and the likes.
- Any leftover glue tasks not solved by composer autoloading should be solved by horde/core or a breakout from it.
- No administrative utilities - that's hordectl's job. Registry just provides the means to call in.
- no notion of users, identities, superadmins, permissions of login state. No session magic.
- No "application-level login" concepts. Applications will login to resources as needed.

## Collaborators
- NLS, localization, translation are optional and, if present, available through the DI.
- Registry has no notion of an initial application page. It asks the app about this
- Logging and early logging are delegated.
- Applications, obviously
- Auto-configuration of application specific interfaces. 

## Backward compatibility
- Little, obviously
- No global variables
- Fallback to the horde base app, if present.
- (maybe) a shim provides an environment suitable for most Horde 5 apps
- apps can install two separate cores for the traditional and new basic infrastructure.
