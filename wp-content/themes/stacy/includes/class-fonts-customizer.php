<?php
require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );
  class WP_Customize_Fonts_Control extends WP_Customize_Control {
      
   /**
     * @access public
     * @var string
     */
    public $type = 'fonts';

    /**
     * @access public
     * @var array
     */
    public $statuses;

    /**
     * Constructor.
     *
     * If $args['settings'] is not defined, use the $id as the setting ID.
     *
     * @since 3.4.0
     * @uses WP_Customize_Control::__construct()
     *
     * @param WP_Customize_Manager $manager
     * @param string $id
     * @param array $args
     */
    public function __construct( $manager, $id, $args = array() ) {
        $this->statuses = array( '' => __('Default') );
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @since 3.4.0
     * @uses WP_Customize_Control::to_json()
     */
    public function to_json() {
        parent::to_json();
        $this->json['statuses'] = $this->statuses;
    }
 
    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <select style="width:100%;" <?php $this->link();?>> 
        <?php for($i=10;$i<=50;$i++): ?>
        <option value="<?php echo $i; ?>" <?php if($this->value() == $i): ?> selected="selected" <?php endif; ?> ><?php echo $i; ?></option>
        <?php endfor; ?>
        </select>
        </label>
        <?php
    }
}
?>