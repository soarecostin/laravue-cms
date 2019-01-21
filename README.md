# laravue-cms

A CMS built with Laravel and Vue, using Bootstrap and Froala Blocks.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/soarecostin/laravue-cms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/soarecostin/laravue-cms/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/soarecostin/laravue-cms/badges/build.png?b=master)](https://scrutinizer-ci.com/g/soarecostin/laravue-cms/build-status/master)

## Demo
[Main site](https://laravue.soa.re/)

[Admin Panel](https://laravue.soa.re/admin)
(Username: admin@soa.re / Password: Admin123)

## Philosophy
One of the pitfalls of the majority of web CMS solutions availabe is that the content of pages is saved as HTML, either in the database or in a flat file, and the content is managed via a WYSYWIG editor. Once a large number of pages have been added, addresssing an error in the markup or simply deciding to change the look of the website becomes a very difficult job, often leading to the re-creation of all pages.

Laravue is designed to address this issue by having only atomic template data saved against each page, leaving the HTML markup in a single template file, easy to be changed in just one place for all the pages created.

Another advantage of this approach, especially for non-technical admins that are managing website content is that they handle simple forms, reducing the number of errors by adding custom content that breaks the design of the website.

For this demo, we are using the awesome [Froala Blocks](https://www.froala.com/design-blocks) templates in order to demonstrate the concept. For your own use, you can define any number of custom templates and transform the CMS to your own design.


## Getting Started

### Installing

Clone the repository
```
git clone https://github.com/soarecostin/laravue-cms
```

Install the dependencies

```
composer install
npm install
```

Because this is a laravel project, follow the same steps as for a fresh Laravel installation. First, copy `.env.example` to `.env` and change it according to your environement.

Next, generate the application key to a random string

```
php artisan key:generate
```

Migrate the database

```
php artisan migrate:fresh --seed
```

## Built With

* [Laravel](https://laravel.com)
* [Vuejs](https://vuejs.org/)
* [Bootstrap 4](https://getbootstrap.com/)
* [Bootstrap-Vue](https://bootstrap-vue.js.org/)
* [vue-form-generator](https://github.com/vue-generators/vue-form-generator)
* [Froala Blocks](https://www.froala.com/design-blocks)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
