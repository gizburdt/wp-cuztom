<?php

namespace Gizburdt\Cuztom\Fields;

use Gizburdt\Cuztom\Cuztom;
use Gizburdt\Cuztom\Support\Guard;

Guard::directAccess();

class Image extends Field
{
    /**
     * Input type.
     * @var string
     */
    protected $_input_type = 'hidden';

    /**
     * CSS class.
     * @var string
     */
    public $css_class = 'cuztom-input-hidden';

    /**
     * Row CSS class.
     * @var string
     */
    public $row_css_class = 'cuztom-field-image';

    /**
     * Data attributes.
     * @var array
     */
    public $data_attributes = array('media-type' => 'image');

    /**
     * Output input(s).
     *
     * @param  string $value
     * @return string
     * @since  2.4
     */
    public function _output_input($value = null)
    {
        Cuztom::view('fields/image', array(
            'field' => $this,
            'value' => $value
        ));
    }

    /**
     * Output column content.
     *
     * @param  string $post_id
     * @return string
     * @since  3.0
     */
    public function output_column_content($post_id)
    {
        $meta = get_post_meta($post_id, $this->id, true);

        echo wp_get_attachment_image($meta, array(100, 100));
    }

    /**
     * Get preview size.
     *
     * @return string
     * @since  3.0
     */
    public function get_preview_size()
    {
        $size = (! Cuztom::is_empty($this->args['preview_size']) ? $this->args['preview_size'] : 'medium');

        return apply_filters('cuztom_field_image_preview_size', $size, $this);
    }
}
