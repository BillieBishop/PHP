<?php

/* login_notfound.html.twig */
class __TwigTemplate_41ac1e2ea7a58a82ac21558b88f3d51e2b123537184bf20591e56a4f3c152a30 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "login_notfound.html.twig", 1);
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
        echo "Login Not Possible";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<a href=\"/addproduct\">Add product</a>&nbsp; &nbsp; 
<a href=\"/register\">Register</a>&nbsp; &nbsp; 
<a href=\"/login\">Login</a>
<br><br>
<h1>We are sorry, you are not in the database.<br>
    Please register in order to continue.</h1>
";
    }

    public function getTemplateName()
    {
        return "login_notfound.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Login Not Possible{% endblock %}

{% block content %}
<a href=\"/addproduct\">Add product</a>&nbsp; &nbsp; 
<a href=\"/register\">Register</a>&nbsp; &nbsp; 
<a href=\"/login\">Login</a>
<br><br>
<h1>We are sorry, you are not in the database.<br>
    Please register in order to continue.</h1>
{% endblock %}
";
    }
}
