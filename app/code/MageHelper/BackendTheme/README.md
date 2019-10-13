# MageHelper Override Magento 2 Backend theme

We will learn here, how to override Magento 2 Backend theme step-by-step.

We can create new module in `app/code/` directory, previously in Magento 1 there were three code pools which are local, community and core but that has been removed now.

In this blog post, we will create new Magento 2 Backend Theme `MageHelper_BackendTheme` and you can download this module as well for practice.

### Step - 1 - Create a directory for the module

- In Magento 2, module name divided into two parts i.e Vendor_Module (for e.g Magento_Theme, Magento_Catalog)
- We will create `MageHelper_BackendTheme` here, So `MageHelper` is vendor name and `BackendTheme` is name of this module.
- So first create your namespace directory (`MageHelper`) and move into that directory.
- Then create module name directory (`BackendTheme`)

Now Go to : `app/code/MageHelper/BackendTheme`

### Step - 2 - Create module.xml file to declare new module.

- Magento 2 looks for configuration information for each module in that module’s etc directory. so we need to add module.xml file here in our module `app/code/MageHelper/BackendTheme/etc/module.xml` and it's content for our module is :

~~~ xml
<?xml version="1.0"?>
<!--
/**
 * MageHelper Override Magento 2 Backend theme
 *
 * @package      MageHelper_BackendTheme
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
-->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="MageHelper_BackendTheme" setup_version="1.0.0">
        <sequence>
            <module name="Magento_Backend"/>
        </sequence>
    </module>
</config>
~~~

In this file, we register a module with name `MageHelper_BackendTheme` and the version is `1.0.0` and we set `<sequence>` there. So this indicates that `Magento_Backend` will load first before our custom theme `MageHelper_BackendTheme`.

### Step - 3 - create registration.php

- All Magento 2 module must be registered in the Magento system through the magento `ComponentRegistrar` class. This file will be placed in module's root directory.

In this step, we need to create this file:

~~~
app/code/MageHelper/BackendTheme/registration.php
~~~

And it’s content for our module is:

~~~ php
<?php
/**
 * MageHelper Override Magento 2 Backend theme
 *
 * @package      MageHelper_BackendTheme
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'MageHelper_BackendTheme',
    __DIR__
);
~~~

### Step - 4 - Enable `MageHelper_BackendTheme` module.

- By finish above step, you have created an empty module. Now we will enable it in Magento environment.
- Before enable the module, we must check to make sure Magento has recognize our module or not by enter the following at the command line:

~~~ 
php bin/magento module:status
~~~

If you follow above step, you will see this in the result:

~~~
List of disabled modules:
MageHelper_BackendTheme
~~~

This means the module has recognized by the system but it is still disabled. Run this command to enable it:

~~~
php bin/magento module:enable MageHelper_BackendTheme
~~~

The module has enabled successfully if you saw this result:

~~~
The following modules has been enabled:
- MageHelper_BackendTheme
~~~

### Step - 5 - Create theme in `design` directory and it's files

- We are creating theme for admin, so we need to create theme directory in design folder here.

~~~
app/design/adminhtml/MageHelper/BackendTheme
~~~

- We will first create `theme.xml` file in this directory.

~~~
app/design/adminhtml/MageHelper/BackendTheme/theme.xml
~~~

Content for this file is :

~~~ xml
<!--
/**
 * MageHelper Override Magento 2 Backend theme
 *
 * @package      MageHelper_BackendTheme
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
-->
<theme xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Config/etc/theme.xsd">
    <title>Magento 2 Backend</title>
    <parent>Magento/backend</parent>
</theme>
~~~

- We will declare parent theme here in this file.

- We will create `registration.php` file to register new admin theme same as our new module.

~~~
app/design/adminhtml/MageHelper/BackendTheme/registration.php
~~~

Content for this file is :

~~~ php
<?php
/**
 * MageHelper Override Magento 2 Backend theme
 *
 * @package      MageHelper_BackendTheme
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::THEME,
    'adminhtml/MageHelper/BackendTheme',
    __DIR__
);

~~~

- We will declare directory of our adminhtml theme here in this file.

- This’s the first time you enable this module so Magento require to check and upgrade module database. We need to run this command:

~~~
php bin/magento setup:upgrade
~~~

- Then after we can override default Magento Backend template files here in `app/design/adminhtml/MageHelper/BackendTheme/` directory.

- I have override copyright file here in this example, and I overrite copyright text there.

***Output***

![MageHelper Override Magento 2 Backend theme output](https://github.com/KishanSavaliya/magehelper-magento2-overrite-backend-theme/blob/master/MageHelper/MageHelper-Magento2-Override-Backend-Theme.png)