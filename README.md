<h1>
  <img src="https://user-images.githubusercontent.com/522079/43096167-3a1b1118-8e86-11e8-9fb2-7b4e3b1368bc.png" width="40" alt="Directus Logo"/>&nbsp;&nbsp;Directus
</h1>

---

[![Build Status](https://github.com/directus/api-next/workflows/Build/badge.svg?branch=master)](https://github.com/directus/api-next)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=api-next&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=api-next)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=api-next&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=api-next)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=api-next&metric=security_rating)](https://sonarcloud.io/dashboard?id=api-next)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=api-next&metric=bugs)](https://sonarcloud.io/dashboard?id=api-next)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=api-next&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=api-next)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=api-next&metric=coverage)](https://sonarcloud.io/dashboard?id=api-next)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=api-next&metric=alert_status)](https://sonarcloud.io/dashboard?id=api-next)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=api-next&metric=sqale_index)](https://sonarcloud.io/dashboard?id=api-next)

---

# WIP

This is a work-in-progress project. Please **DO NOT** use this for any kind of environment besides development, testing and out of curiosity only.

# Objectives

-   Properly tested codebase
    -   Keep track of code coverage
    -   Static code analysis
-   Code quality
    -   Linting
    -   Code style checks and fixes

# Installing

To install Directus package, you should make some changes to your `composer.json` file. Then you can use the `directus/directus` package using `dev-*` versions. This requirement is temporary as we develop the new version.

## Allow "dev" stability

```
    "minimum-stability": "dev",
```

## Add the repository

```json
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@github.com:directus/api-next.git"
        }
    ]
```

## (OR) Add a local repository

If you want to use a local repository, you should use a symlink instead.

```json
    "repositories": [
        {
            "type": "path",
            "url": "/path/to/directus/api-next",
            "symlink": true
        }
    ],
```

## Add the dependency

```
composer require directus/directus
```
