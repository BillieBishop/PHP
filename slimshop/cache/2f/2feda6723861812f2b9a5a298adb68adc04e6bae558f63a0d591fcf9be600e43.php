<?php

/* register.html.twig */
class __TwigTemplate_4cacce8ce49c2ecb6c1f976f1b8fc86a4e96052740feb01fe6b2c46707e7b812 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "register.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
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
    public function block_head($context, array $blocks = array())
    {
        echo "    
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
    <script>
        \$(document).ready(function () {
            \$('input[name=email]').keyup(function(){
                \$('#result').load('/emailexists/' + \$(this).val());
            });
        });
    </script>
";
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "    <h1>Register</h1>

    ";
        // line 19
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 20
            echo "        <ul>
            ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 22
                echo "                <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "        </ul>
    ";
        }
        // line 26
        echo "
    <form method=\"post\">
        Name:<input type=\"text\" name=\"name\" value=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "name", array()), "html", null, true);
        echo "\"><br><br>
        Email:<input type=\"text\" name=\"email\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "email", array()), "html", null, true);
        echo "\">
            <span id=\"result\"></span><br><br>
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
        return array (  88 => 29,  84 => 28,  80 => 26,  76 => 24,  67 => 22,  63 => 21,  60 => 20,  58 => 19,  54 => 17,  51 => 16,  36 => 5,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Register{% endblock %}

{% block head %}    
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
    <script>
        \$(document).ready(function () {
            \$('input[name=email]').keyup(function(){
                \$('#result').load('/emailexists/' + \$(this).val());
            });
        });
    </script>
{% endblock %}

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
        Email:<input type=\"text\" name=\"email\" value=\"{{v.email}}\">
            <span id=\"result\"></span><br><br>
        Password:<input type=\"text\" name=\"password\"><br><br>
        Password (retype):<input type=\"text\" name=\"password2\"><br><br>
        <input type=\"submit\" value=\"Register\">
    </form>
{% endblock %}
";
    }
}
