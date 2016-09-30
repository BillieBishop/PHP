<?php

/* register_success.html.twig */
class __TwigTemplate_380e40934ef060e540115e7cd634fe7bf9e7c3480bc9aa3d99e80d979f3aadb8 extends Twig_Template
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
        echo " with ";
        echo twig_escape_filter($this->env, (isset($context["passport"]) ? $context["passport"] : null), "html", null, true);
        echo "<br>
    has been added in the database.</p>
<a href=\"../index.php\">Click to continue</a><br><br>
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
<p>{{name}} with {{passport}}<br>
    has been added in the database.</p>
<a href=\"../index.php\">Click to continue</a><br><br>
{% endblock %}









";
    }
}
