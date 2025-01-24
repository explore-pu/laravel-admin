# laravel-admin

> Note: Don't use this package on older projects! Don't use this package for older projects! Don't use this package for older projects!
> 
> This package can only be authenticated in a single table, and is only suitable for independent management-side backend.
>
> - Modern applications are basically separated from the front and back, which is easy to deploy
> - It is more secure to deploy the management side and the user side separately

- [Documentation](https://explore-pu.github.io/laravel-admin-docs/)
- [中文文档](https://explore-pu.github.io/laravel-admin-docs/zh-CN)
- [Extensions](#extensions)

Requirements
------------
 - PHP >= 8.1
 - Laravel  ^11.0
 - Fileinfo PHP Extension

Installation
------------

> This package requires PHP 8.1+ and Laravel 11.0

First, install laravel 11.0, and make sure that the database connection settings are correct.

```
composer require elegance/laravel-admin
```

Then run these commands to publish assets and config：

```
php artisan vendor:publish --provider="Elegance\Admin\AdminServiceProvider"
```

After run command you can find config file in `config/admin.php`, in this file you can change the install directory,db connection or table names.

At last run following command to finish install.

```
php artisan admin:install
```

Open `http://localhost/` in browser,use username `admin@admin.com` and password `admin` to login.

Configurations
------------
The file `config/admin.php` contains an array of configurations, you can find the default configurations in there.

## Extensions

| Extension                                        | Description                              | laravel-admin                              |
| ------------------------------------------------ | ---------------------------------------- |---------------------------------------- |
| [helpers](https://github.com/laravel-admin-utils/helpers)             | Several tools to help you in development | ~1.5 |
| [media-manager](https://github.com/laravel-admin-utils/media-manager) | Provides a web interface to manage local files          | ~1.5 |
| [api-tester](https://github.com/laravel-admin-utils/api-tester) | Help you to test the local laravel APIs          |~1.5 |
| [scheduling](https://github.com/laravel-admin-utils/scheduling) | Scheduling task manager for laravel-admin          |~1.5 |
| [redis-manager](https://github.com/laravel-admin-utils/redis-manager) | Redis manager for laravel-admin          |~1.5 |
| [backup](https://github.com/laravel-admin-utils/backup) | An admin interface for managing backups          |~1.5 |
| [log-viewer](https://github.com/laravel-admin-utils/log-viewer) | Log viewer for laravel           |~1.5 |
| [config](https://github.com/laravel-admin-utils/config) | Config manager for laravel-admin          |~1.5 |
| [reporter](https://github.com/laravel-admin-utils/reporter) | Provides a developer-friendly web interface to view the exception          |~1.5 |
| [wangEditor](https://github.com/laravel-admin-utils/wangEditor) | A rich text editor based on [wangeditor](http://www.wangeditor.com/)         |~1.6 |
| [summernote](https://github.com/laravel-admin-utils/summernote) | A rich text editor based on [summernote](https://summernote.org/)          |~1.6 |
| [china-distpicker](https://github.com/laravel-admin-utils/china-distpicker) | 一个基于[distpicker](https://github.com/fengyuanchen/distpicker)的中国省市区选择器          |~1.6 |
| [simplemde](https://github.com/laravel-admin-utils/simplemde) | A markdown editor based on [simplemde](https://github.com/sparksuite/simplemde-markdown-editor)          |~1.6 |
| [phpinfo](https://github.com/laravel-admin-utils/phpinfo) | Integrate the `phpinfo` page into laravel-admin          |~1.6 |
| [php-editor](https://github.com/laravel-admin-utils/php-editor) <br/> [python-editor](https://github.com/laravel-admin-utils/python-editor) <br/> [js-editor](https://github.com/laravel-admin-utils/js-editor)<br/> [css-editor](https://github.com/laravel-admin-utils/css-editor)<br/> [clike-editor](https://github.com/laravel-admin-utils/clike-editor)| Several programing language editor extensions based on code-mirror          |~1.6 |
| [star-rating](https://github.com/laravel-admin-utils/star-rating) | Star Rating extension for laravel-admin          |~1.6 |
| [json-editor](https://github.com/laravel-admin-utils/json-editor) | JSON Editor for Laravel-admin          |~1.6 |
| [grid-lightbox](https://github.com/laravel-admin-utils/grid-lightbox) | Turn your grid into a lightbox & gallery          |~1.6 |
| [daterangepicker](https://github.com/laravel-admin-utils/daterangepicker) | Integrates daterangepicker into laravel-admin          |~1.6 |
| [material-ui](https://github.com/laravel-admin-utils/material-ui) | Material-UI extension for laravel-admin          |~1.6 |
| [sparkline](https://github.com/laravel-admin-utils/sparkline) | Integrates jQuery sparkline into laravel-admin          |~1.6 |
| [chartjs](https://github.com/laravel-admin-utils/chartjs) | Use Chartjs in laravel-admin          |~1.6 |
| [echarts](https://github.com/laravel-admin-utils/echarts) | Use Echarts in laravel-admin          |~1.6 |
| [simditor](https://github.com/laravel-admin-utils/simditor) | Integrates simditor full-rich editor into laravel-admin          |~1.6 |
| [cropper](https://github.com/laravel-admin-utils/cropper) | A simple jQuery image cropping plugin.          |~1.6 |
| [composer-viewer](https://github.com/laravel-admin-utils/composer-viewer) | A web interface of composer packages in laravel.          |~1.6 |
| [data-table](https://github.com/laravel-admin-utils/data-table) | Advanced table widget for laravel-admin |~1.6 |
| [watermark](https://github.com/laravel-admin-utils/watermark) | Text watermark for laravel-admin |~1.6 |

Other
------------
`laravel-admin` based on following plugins or services:

+ [Laravel](https://laravel.com/)
+ [AdminLTE](https://adminlte.io/)
+ [Datetimepicker](http://eonasdan.github.io/bootstrap-datetimepicker/)
+ [font-awesome](http://fontawesome.io)
+ [moment](http://momentjs.com/)
+ [Google map](https://www.google.com/maps)
+ [Tencent map](http://lbs.qq.com/)
+ [bootstrap-fileinput](https://github.com/kartik-v/bootstrap-fileinput)
+ [jquery-pjax](https://github.com/defunkt/jquery-pjax)
+ [Nestable](http://dbushell.github.io/Nestable/)
+ [toastr](http://codeseven.github.io/toastr/)
+ [X-editable](http://github.com/vitalets/x-editable)
+ [bootstrap-number-input](https://github.com/wpic/bootstrap-number-input)
+ [fontawesome-iconpicker](https://github.com/itsjavi/fontawesome-iconpicker)
+ [sweetalert2](https://github.com/sweetalert2/sweetalert2)

License
------------
`laravel-admin` is licensed under [The MIT License (MIT)](LICENSE).
