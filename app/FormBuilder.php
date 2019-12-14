<?php
class FormBuilder {

    private $form_title;
    private $_steps = [];
    private $_fields = [];

    /**
     * Create a new form.
     * @param {string} $title The form's title.
     */
    public function __construct( $title ) {
        $this->form_title = $title;
    }

    /**
     * Add a step to the form.
     * 
     * @param {string} $key A unique key identifying the step.
     * @param {string} $title The title of the step, shown to the end user.
     * @param {string} $description The description of the step, shown to the end user.
     */
    public function add_step( $key, $title, $description ) {
        // First, ensure the key for the step is unique.
        foreach( $this->_steps as $step ) {
            if( $step['key'] == $key ) {
                throw new \Exception( 'The specified key, ' . $key . ', is already in use.' );
            }
        }

        $this->_steps[] = [
            'key'   => $key,
            'title' => $title,
            'desc'  => $description,
        ];
    }

    /**
     * Add a field to the form.
     * @param {string} $name A unique key identifying the field.
     * @param {string} $type The type of the field -- used when assigning it to a component.
     * @param {array} $props Props to assign to the field
     * @param {$string} $parent The key of the parent. 
     */
    public function add_field( $name, $type, $props, $parent ) {
        // First, ensure the given key is unique.
        foreach( $this->_fields as $field ) {
            if( $field['key'] == $name ) {
                throw new \Exception( 'The specified key, ' . $name . ', is already in use.' );
            }
        }

        $this->_fields[] = [
            'key'       => $name,
            'type'      => $type,
            'props'     => $props,
            'parent'    => $parent,
        ];
    }

    /**
     * Generate the currently-registered form.
     */
    public function generate() {
        $form_details = [ 'header' => $this->form_title, 'steps' => [] ];
        foreach( $this->_steps as $step ) {
            $step_details = [ 'header' => $step['title'], 'desc' => $step['desc'], 'body' => $this->get_children_of( $step['key'] ) ];
            $form_details['steps'][] = $step_details;
        }

        return $form_details;
    }

    /**
     * Fetch the children of a given form element.
     * @return {array}
     */
    private function get_children_of( $key ) {
        $children = [];

        foreach( $this->_fields as $field ) {
            if( $field['parent'] == $key ) {
                $field_data = [ 'type' => $field[ 'type' ], 'name' => $field['key'] ];
                foreach( $field['props'] as $k => $v ) {
                    $field_data[ $k ] = $v;
                }

                $possible_children = $this->get_children_of( $field['key'] );
                if( sizeof( $possible_children ) ) {
                    $field_data[ 'fields' ] = $possible_children;
                }

                $children[] = $field_data;
            }
        }

        return $children;
    }
}