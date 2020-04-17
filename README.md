[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-3.0.en.html)  

# Sample Plugin
**Tags:** Inpsyde, User Table
**License:** GPLv3 or later
**License URI:** http://www.gnu.org/licenses/gpl-3.0.html

Make available a custom endpoint on the WordPress site. With “custom endpoint” we mean an arbitrary URL not recognized by WP as a standard URL, like a permalink or so.

### Description

The plugin will make available a custom endpoint in the Wordpress Site, that custom enpdoint will show a table with a list of users coming from an external API (_http://jsonplaceholder.typicode.com/users/_).

When an user is clicked a dialog will display showing the selected user details.

The default endpoint is http://YOURDOMAIN.COM/usertable where _YOURDOMAIN_ is your site domain name.

You can also:
  - Edit the default endpoint in the WordpPress Admin Panel by going to the option "Inpsyde Settings" showing in the left sidebar.


### Tech

* [jQuery] - JavaScript Library which greatly simplifies JavaScript programming
* [jQuery Datatable]  is a plug-in for the jQuery Javascript library that adds advanced interaction controls to your HTML tables
* [Ajax] - AJAX allows web pages to be updated asynchronously by exchanging data with a web server behind the scenes

## Installation

Install with [Composer](https://getcomposer.org):

```sh
$ composer require jeanpaul4289/inpsyde-usertable
```

### Requirements

This package requires PHP 7.2 or higher.


### License
----

GNU GPL v3


   [jQuery Datatable]: <https://datatables.net/>
   [jQuery]: <http://jquery.com>
   [ajax]: <https://api.jquery.com/jquery.ajax/>
