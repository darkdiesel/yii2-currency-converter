<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](https://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

## Steps to install Yii2:

1. Install via command: ```composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application```
2. Init : ```php init```
3. Create DB and update **common/config/main-local.php**
4. Run migration ```php yii migrate```

## Steps to run application:

1. Use docker or setup 2 hosts `admin` to `/backend/web` and `front` to `frontend/web`
2. Open site with browser and go to sign up page.
3. Fill fields and create user.
4. Go to `frontend\runtime\mail\` and open `*.eml file`
5. Copy confirm url from file and made some next modification to it:
   - for example we have next url: 
   ```
    http://currency-converter.loc/index.p=
    hp?r=3Dsite%2Fverify-email&amp;token=3DL13CX6Fro9E_MYdJ8gGRK_0GCleoRpBa_170=
    2598408
   ```
- delete soft line breaks ‘=’ and newlines to create a single line with the line below
- change ‘=3D’ to ‘=’ // after r and after token
- change ‘&amp;‘ to '&'
- change ‘%2F‘ to ‘/‘
- and we have `http://currency-converter.loc/index.php?r=site/verify-email&token=3DL13CX6Fro9E_MYdJ8gGRK_0GCleoRpBa_1702598408`
- put this url to browser and if everything is ok your user will be verified  
6. Go to currencies page and click refresh button to download last data
7. Go to front site, click Currency converter main menu link and you will see widget

## Useful commands:

## Migration:
* Run migration ```php yii migrate```
* Revert last migration ```yii migrate/redo```
* Refresh migration ```yii migrate/fresh ```