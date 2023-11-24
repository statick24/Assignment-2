<?php

namespace View;

/**
 * Abstract Template Engine Class
 *
 * This abstract class provides a partial implementation of the TemplateEngineInterface
 * for managing template-related operations within the MVP framework's view module.
 */
abstract class AbstractTemplateEngine implements InterfaceTemplateEngine
{
    /**
     * @var array An associative array to store assigned variables for templates.
     */
    protected $variables = []; // stores template variables

    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function createDiv($content, $class = '')
    {
        if (!empty($class)) {
            return "<div class=\"$class\">$content</div>";
        } else {
            return "<div>$content</div>";
        }
    }

    abstract public function render($tpl);
}
