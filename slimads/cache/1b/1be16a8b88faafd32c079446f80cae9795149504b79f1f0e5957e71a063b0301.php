<?php

/* postadform.html.twig */
class __TwigTemplate_8e55b034a57717fdccd8b8fe71bb5de4e015d710f2a6944fe7fa8f0d3e26af02 extends Twig_Template
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
        echo "<h1>Post ad</h1>

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
    Message:<br>
    <textarea rows=\"5\" cols=\"50\" name=\"msg\">";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "msg", array()), "html", null, true);
        echo "</textarea><br><br>
    Price:<input type=\"text\" name=\"price\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "price", array()), "html", null, true);
        echo "\"><br><br>
    Contact email:<input type=\"text\" name=\"contactEmail\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "contactEmail", array()), "html", null, true);
        echo "\"><br><br>
    <input type=\"submit\" value=\"Post ad\">
</form>
";
    }

    public function getTemplateName()
    {
        return "postadform.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 16,  54 => 15,  50 => 14,  45 => 11,  41 => 9,  32 => 7,  28 => 6,  25 => 5,  23 => 4,  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}
<h1>Post ad</h1>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
            {% endfor %}
    </ul>
{% endif %}

<form method=\"post\">
    Message:<br>
    <textarea rows=\"5\" cols=\"50\" name=\"msg\">{{v.msg}}</textarea><br><br>
    Price:<input type=\"text\" name=\"price\" value=\"{{v.price}}\"><br><br>
    Contact email:<input type=\"text\" name=\"contactEmail\" value=\"{{v.contactEmail}}\"><br><br>
    <input type=\"submit\" value=\"Post ad\">
</form>
";
    }
}
