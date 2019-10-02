# WordPress base project

Project template to build modern WordPress sites, based on Studio 24 standards. Inspired by [Bedrock](https://roots.io/bedrock/).

## Issues

Cannot load ACF Pro via Composer without exposing auth token in git repo.

See https://roots.io/guides/acf-pro-as-a-composer-dependency-with-encrypted-license-key/

## Directory structure

```
├── composer.json
├── config
├── vendor
└── web
    ├── content
    │   ├── mu-plugins
    │   ├── plugins
    │   ├── themes
    │   └── uploads
    ├── wp-config.php
    ├── index.php
    └── wordpress
```

## Requirements

* PHP 7.1+
* [Composer](https://getcomposer.org/) 

## Installation

### Create project

To create a new project based on this WordPress base project run the following, replacing "project" with the name of 
the directory you wish to create the new WordPress project in.

    composer create-project studio24/wordpress-base project

_TODO add to Packagist to make the above work_

### Apache

Copy the following to your Apache `<Directory>` configuration. 

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index.php$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
</IfModule>
```

Secure your upload folder by disabling PHP from running within this folder:

```
<Directory /path/to/web/content/uploads>
    RemoveType application/x-httpd-php .php .phtml
</Directory>
```

## Managing WordPress via Composer

### Software versions
Composer supports software updates via [semantic versioning](https://semver.org/) which classifies software 
updates into major, minor or patch versions. For example WordPress 5.0 is a major release, 5.2.0 is a minor 
release and 5.2.3 is a patch release.

Running `composer install` installs the current version of WordPress and plugins, according to what is stored in the 
`composer.lock` file. This ensures all team members are working on the same software versions.

When you run `composer update` it attempts to update to the latest version, according to the version constraint you have 
defined in your `composer.json` file.

We normally use the following [version constraint](https://getcomposer.org/doc/articles/versions.md) when loading packages:

* `^5.3` marks the minimum version as 5.3 but accepts any update below 6.0
* This is equivalent to `>5.3.0 <6.0.0`

### Adding a plugin via Composer

WordPress plugins are loaded via [WordPress Packagist](https://wpackagist.org/).

Add the required plugin to your Composer file prefixed by `wpackagist-plugin/`, you can find out the exact package name 
at WordPress Packagist. 

E.g. to load ACF 5 with a minimum version of 5.8:

```
"wpackagist-plugin/advanced-custom-fields": "^5.8"
```

### Adding a local plugin to your codebase

You can also just add a plugin or theme directly to your codebase, for example if you want to develop a plugin just for this
website. 

Simply create your plugin folder in `web/content/plugins` as normal. Next you need to allow these files to be added to version control

```
!web/content/plugins/your-plugin-name
```

Please note it's recommended to load any third-party plugins via Composer as noted above.

### Must-use plugins

If you develop any plugins the site must have in order to operate, it is recommended you add these to the `mu-plugins` 
folder. Must-use plugins are automatically enabled and cannot be disabled.

The Base WordPress project includes `mu-plugins/s24-wordpress-base.php`, to help set a number of 
secure defaults in a WordPress install.

Please note the _caveats_ section on the [Must-use plugins](https://wordpress.org/support/article/must-use-plugins/) documentation 
to see if this is a suitable solution for you. 

### Adding PHP packages

If you need to load a PHP package you can do so as normal via Composer. Just find the package on
[Packagist](https://packagist.org/) and add to your `composer.json` file.

### Upgrading WordPress and WordPress plugins

Using the above version constraint (e.g. `^5.3`) to update a minor or patch version run `composer update`

To upgrade WordPress or a plugin to a new major version, you'll need to update your version constraint in your `composer.json` 
file. E.g. to upgrade to WordPress 6.0:

```
"johnpbloch/wordpress" : "^6.0",
```

## References

* [Composer in WordPress](https://composer.rarst.net/)

## Contributions

Please do contribute! Issues and pull requests are welcome.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[LICENSE]: ./LICENSE
[license-badge]: https://img.shields.io/badge/license-MIT-blue.svg
