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