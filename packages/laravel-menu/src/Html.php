<?php

namespace Akaunting\Menu;

use Illuminate\Support\HtmlString;

/**
 * Minimal replacement for the abandoned "laravelcollective/html" package.
 *
 * Only the attribute builder is used by this package, so it is reimplemented
 * here to keep the dependency tree free of packages that stopped at Laravel 10.
 */
class Html
{
    /**
     * Build an HTML attribute string from an array.
     *
     * @param  array  $attributes
     * @return string
     */
    public static function attributes($attributes)
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = static::attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return string|null
     */
    protected static function attributeElement($key, $value)
    {
        // Treat numeric keys as boolean attributes, e.g. ['required'].
        if (is_numeric($key)) {
            $key = $value;
        }

        if (is_bool($value) && $key !== 'value') {
            return $value ? $key : null;
        }

        if (is_array($value) && $key === 'class') {
            return 'class="' . implode(' ', $value) . '"';
        }

        if ($value instanceof HtmlString) {
            $value = $value->toHtml();
        }

        if (! is_null($value)) {
            return $key . '="' . e($value, false) . '"';
        }

        return null;
    }
}
