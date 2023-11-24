<?php 
namespace View;
/**
 * Template Engine Class
 *
 * This class extends the AbstractTemplateEngine class, providing specific implementations
 * for managing template-related operations, including rendering, within the MVP framework's view module.
 */
class TemplateEngine extends AbstractTemplateEngine {
    public function render($tpl)
    {
        if (file_exists($tpl)) {
            ob_start();
            extract($this->variables);
            include $tpl;
            echo ob_get_clean();
        } else {
            echo "Template not found";
        }
    }
}
?>