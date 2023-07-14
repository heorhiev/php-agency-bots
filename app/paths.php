<?php

const APP_PATH = __DIR__ . '/';
const CONFIG_PATH = APP_PATH . '/config';
const RUNTIME_PATH = APP_PATH . '/runtime';
const LOGS_PATH = RUNTIME_PATH . '/logs';

const VIEWS_PATH = APP_PATH . '/views';

const ALIASES = [
    '{@configPath}' => CONFIG_PATH,
];