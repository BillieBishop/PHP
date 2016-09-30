<?php

/* register_success.html.twig */
class __TwigTemplate_4d6f38d74c1f3cb4dc4ac10c7a33bcf425fe222484c351e33c07d3d05858fb0a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "register_success.html.twig", 1);
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
        echo "Registration successful";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<a href=\"/login\">Login</a>
<br><br>
<p>";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo " at ";
        echo twig_escape_filter($this->env, (isset($context["email"]) ? $context["email"] : null), "html", null, true);
        echo "<br>
    has been added in the database.</p>
<a href=\"../index.php\">See products</a><br><br>
";
    }

    public function getTemplateName()
    {
        return "register_success.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 8,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Registration successful{% endblock %}

{% block content %}
<a href=\"/login\">Login</a>
<br><br>
<p>{{name}} at {{email}}<br>
    has been added in the database.</p>
<a href=\"../index.php\">See products</a><br><br>
{% endblock %}









";
    }
}
