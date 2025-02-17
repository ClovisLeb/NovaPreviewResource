<?php

declare(strict_types=1);

namespace Caddydz\NovaPreviewResource;

use Laravel\Nova\Fields\Field;

class NovaPreviewResource extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-preview-resource';

    /**
     * The text alignment for the field's text in tables.
     *
     * @var string
     */
    public $textAlign = 'center';

    /**
     * Set the image for the preview.
     *
     * @param string image path
     *
     * @return $this
     */
    public function image($path)
    {
        return $this->withMeta([
            'image' => $path,
        ]);
    }

    /**
     * Set the image width for the preview.
     *
     * @param int image width
     *
     * @return $this
     */
    public function width($width)
    {
        return $this->withMeta([
            'width' => $width,
        ]);
    }

    /**
     * Display the image as a squared image.
     *
     * @return $this
     */
    public function squared()
    {
        return $this->withMeta([
            'squared' => true,
        ]);
    }

    /**
     * Display the image as a rounded image.
     *
     * @return $this
     */
    public function rounded()
    {
        return $this->withMeta([
            'rounded' => true,
        ]);
    }

    /**
     * Set the options for the field.
     *
     * @param  array|\Closure|\Illuminate\Support\Collection
     * @return $this
     */
    public function options($options)
    {
        info($options);
        if (is_callable($options)) {
            $options = $options();
        }

        return $this->withMeta([
            'options' => with(collect($options), function ($options) {
                return $options->map(function ($label, $name) use ($options) {
                    return $options->isAssoc()
                        ? ['label' => $label, 'name' => $name]
                        : ['label' => $label, 'name' => $label];
                })->values()->all();
            }),
        ]);
    }
}