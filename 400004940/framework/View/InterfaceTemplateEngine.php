<?php 
namespace View;
/**
 * Template Engine Interface
 *
 * This interface defines methods for managing template-related operations
 * within the MVP framework's view module.
 */
interface InterfaceTemplateEngine {
    /**
     * Assign Variable to Template
     *
     * Assigns a variable to be used in the template.
     *
     * @param string $name  The name of the variable.
     * @param mixed  $value The value to assign to the variable.
     */
    public function assign( $name, $value );
    /**
     * Create Div Element
     *
     * Creates a <div> element with the specified content and optional class.
     *
     * @param string $content The content of the <div> element.
     * @param string $class   (Optional) The CSS class for the <div> element.
     *
     * @return string The HTML representation of the <div> element.
     */
    public function createDiv($content, $class = "");
    /**
     * Render Template
     *
     * Renders the specified template.
     *
     * @param string $tpl The path or identifier of the template to render.
     */
    public function render($tpl);
}
?>