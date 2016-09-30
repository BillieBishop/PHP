<?php

/* register.html.twig */
class __TwigTemplate_b833294731c2c5cbc1d403d36c8ff4b9004bd0c32d5cd1b407bc2943f7999b9a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "register.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "master.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Register";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<h1>Register</h1>

";
        // line 8
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 9
            echo "    <ul>
        ";
            // line 10
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 11
                echo "            <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 13
            echo "    </ul>
";
        }
        // line 15
        echo "
<form method=\"post\">
    Name:<input type=\"text\" name=\"name\" value=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "name", array()), "html", null, true);
        echo "\"><br><br>
    Passport #:<input type=\"text\" name=\"passport\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "passport", array()), "html", null, true);
        echo "\"><br><br>
    Password:<input type=\"text\" name=\"password\"><br><br>
    Password (retype):<input type=\"text\" name=\"password2\"><br><br>
    <input type=\"submit\" value=\"Register\">
</form>
";
    }

    public function getTemplateName()
    {
        return "register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 18,  68 => 17,  64 => 15,  60 => 13,  51 => 11,  47 => 10,  44 => 9,  42 => 8,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Register{% endblock %}

{% block content %}
<h1>Register</h1>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
            {% endfor %}
    </ul>
{% endif %}

<form method=\"post\">
    Name:<input type=\"text\" name=\"name\" value=\"{{v.name}}\"><br><br>
    Passport #:<input type=\"text\" name=\"passport\" value=\"{{v.passport}}\"><br><br>
    Password:<input type=\"text\" name=\"password\"><br><br>
    Password (retype):<input type=\"text\" name=\"password2\"><br><br>
    <input type=\"submit\" value=\"Register\">
</form>
{% endblock %}
";
    }
}
