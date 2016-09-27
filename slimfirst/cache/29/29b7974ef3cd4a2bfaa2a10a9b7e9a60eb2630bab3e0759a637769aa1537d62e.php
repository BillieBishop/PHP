<?php

/* sayhello.html.twig */
class __TwigTemplate_8c82b061169f35fba60fc975f55988b5c8cd47d297f53938e410688ca87db6de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<h1>Say hello</h1>

";
        // line 4
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 5
            echo "    <ul>
        ";
            // line 6
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 7
                echo "            <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 9
            echo "    </ul>
";
        }
        // line 11
        echo "
<form method=\"post\">
    Name:<input type=\"text\" name=\"name\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "name", array()), "html", null, true);
        echo "\"><br>
    Age:<input type=\"number\" name=\"age\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "age", array()), "html", null, true);
        echo "\"><br>
    <input type=\"submit\" value=\"Say hello\">
</form>
";
    }

    public function getTemplateName()
    {
        return "sayhello.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 14,  49 => 13,  45 => 11,  41 => 9,  32 => 7,  28 => 6,  25 => 5,  23 => 4,  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}
<h1>Say hello</h1>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
            {% endfor %}
    </ul>
{% endif %}

<form method=\"post\">
    Name:<input type=\"text\" name=\"name\" value=\"{{v.name}}\"><br>
    Age:<input type=\"number\" name=\"age\" value=\"{{v.age}}\"><br>
    <input type=\"submit\" value=\"Say hello\">
</form>
";
    }
}
