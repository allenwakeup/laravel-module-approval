<?php
if (! function_exists ('approval_config')) {
    /**
     * Get / set the specified configuration value from modules.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null  $key
     * @param  mixed  $default
     * @return mixed|\Illuminate\Config\Repository
     */
    function approval_config ($key, $default = null)
    {
        return config ('approval.' . $key, $default);
    }
}

if (! function_exists ('bpmn_path')) {
    /**
     * Get BPMN storage relative path.
     *
     * @param  string|null  $path relative path that append to storage path
     * @return string
     */
    function bpmn_path ($path)
    {
        return rtrim(approval_config('bpmn_path'), '/') . '/' . ltrim($path, '/');
    }
}