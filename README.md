# WordPress base project

Project template to build modern WordPress sites, based on Studio 24 standards. Inspired by [Bedrock](https://roots.io/bedrock/).

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

## Usage

### Upgrading WordPress

To update to a minor version `composer update` should work.

### Adding a plugin

WordPress plugins are loaded via WordPress Packagist.

Add the required plugin to your Composer file prefixed by `wpackagist-plugin/`, you can find out the exact package name 
[WordPress Packagist](https://wpackagist.org/).

```
"wpackagist-plugin/timber-library": "1.*"
```

This example installs the latest 1.* version of Timber (e.g. 1.11.0). To upgrade to a newer version you may need to update 
the [version constraint in Composer](https://getcomposer.org/doc/articles/versions.md). 

## References

* [Composer in WordPress](https://composer.rarst.net/)

## Contributions

Please do contribute! Issues and pull requests are welcome.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[LICENSE]: ./LICENSE
[license-badge]: https://img.shields.io/badge/license-MIT-blue.svg
